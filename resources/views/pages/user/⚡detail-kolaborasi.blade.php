<?php

use Livewire\Component;
use App\Models\wilayahKolaborasi;
use Carbon\Carbon;

new class extends Component
{
    public $wilayah;

    public $kolaborasi = [];

    public $selectedDate;

    public $month;

    public $year;


    public function mount($id)
    {
        $this->wilayah = wilayahKolaborasi::findOrFail($id);

        $this->month = now()->month;
        $this->year = now()->year;

        // Tanggal yang dipilih pertama kali adalah hari ini
        $this->selectedDate = now()->format('Y-m-d');

        $this->loadKolaborasi();
    }


    public function loadKolaborasi()
    {
        $this->kolaborasi = $this->wilayah
            ->kolaborasi()
            ->where('is_active', true)
            ->orderBy('tanggal_mulai')
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | Pilih tanggal
    |--------------------------------------------------------------------------
    */

    public function selectDate($date)
    {
        $this->selectedDate = $date;
    }


    /*
    |--------------------------------------------------------------------------
    | Pindah bulan
    |--------------------------------------------------------------------------
    */

    public function previousMonth()
    {
        $date = Carbon::create(
            $this->year,
            $this->month,
            1
        )->subMonth();

        $this->month = $date->month;
        $this->year = $date->year;
    }


    public function nextMonth()
    {
        $date = Carbon::create(
            $this->year,
            $this->month,
            1
        )->addMonth();

        $this->month = $date->month;
        $this->year = $date->year;
    }


    /*
    |--------------------------------------------------------------------------
    | Kembali ke bulan sekarang
    |--------------------------------------------------------------------------
    */

    public function currentMonth()
    {
        $this->month = now()->month;
        $this->year = now()->year;

        $this->selectedDate = now()->format('Y-m-d');
    }


    /*
    |--------------------------------------------------------------------------
    | Cek apakah tanggal mempunyai event
    |--------------------------------------------------------------------------
    */

    public function hasEvent($date)
    {
        return $this->kolaborasi->contains(function ($item) use ($date) {

            $start = Carbon::parse($item->tanggal_mulai);
            $end = Carbon::parse($item->tanggal_selesai);

            return $date->betweenIncluded($start, $end);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Ambil event berdasarkan tanggal yang dipilih
    |--------------------------------------------------------------------------
    */

    public function getSelectedKolaborasiProperty()
    {
        if (!$this->selectedDate) {
            return collect();
        }

        $selected = Carbon::parse($this->selectedDate);

        return $this->kolaborasi->filter(function ($item) use ($selected) {

            $start = Carbon::parse($item->tanggal_mulai);
            $end = Carbon::parse($item->tanggal_selesai);

            return $selected->betweenIncluded($start, $end);
        });
    }


    /*
    |--------------------------------------------------------------------------
    | Kalender
    |--------------------------------------------------------------------------
    */

    public function getCalendarDaysProperty()
    {
        $firstDay = Carbon::create(
            $this->year,
            $this->month,
            1
        );

        $lastDay = $firstDay->copy()->endOfMonth();

        /*
        Senin = 1
        Minggu = 7
        */

        $start = $firstDay->copy()->startOfWeek(Carbon::MONDAY);
        $end = $lastDay->copy()->endOfWeek(Carbon::SUNDAY);

        $days = [];

        while ($start->lte($end)) {

            $days[] = $start->copy();

            $start->addDay();
        }

        return $days;
    }


    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Kolaborasi ' . $this->wilayah->nama_wilayah
            ]);
    }
};
?>

<section class="flex flex-col gap-6 py-4 w-full h-full justify-center items-center">

    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-2">

        <div class="flex flex-wrap gap-2 w-full">

            <a
                href="{{ route('kolaborasi') }}"
                class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case"
            >
                Kolaborasi :
            </a>

            <p class="font-[poppins] font-normal lg:text-2xl md:text-lg text-base">
                {{ $wilayah->nama_wilayah }}
            </p>

        </div>

    </article>


    {{-- =====================================================
        CONTENT
    ====================================================== --}}
    <article class="flex flex-wrap justify-center w-[90%] h-full gap-6">


        {{-- =================================================
            DAFTAR KOLABORASI
        ================================================== --}}
        <div class="flex flex-col lg:w-[58%] md:w-[58%] w-full h-full gap-6 lg:order-1 md:order-1 order-2">

            <div class="flex flex-col w-full gap-4">

                <div class="flex justify-between items-center">

                    <div>
                        <h1 class="font-[poppins] font-semibold lg:text-xl md:text-lg text-base">
                            Kolaborasi
                        </h1>

                        <p class="font-[poppins] text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                </div>


                <div class="border-b border-gray-300"></div>


                {{-- =========================================
                    DATA BERDASARKAN TANGGAL
                ========================================== --}}
                @forelse ($this->selectedKolaborasi as $item)

                    @php
                        $images = $item->image
                            ? json_decode($item->image, true)
                            : [];

                        $firstImage = !empty($images)
                            ? asset('storage/' . $images[0])
                            : asset('img/no-image.jpg');
                    @endphp

                    <a
                        href="{{ route('detail-kolaborasi', $item->id) }}"
                        class="flex w-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-[1.01] transition-transform duration-150"
                    >

                        {{-- GAMBAR --}}
                        <div class="flex lg:w-90 md:w-80 w-32 lg:h-40 md:h-30 h-24 shrink-0 bg-gray-400 rounded-lg overflow-hidden">

                            <img
                                src="{{ $firstImage }}"
                                alt="{{ $item->nama_kolaborasi }}"
                                class="w-full h-full object-cover"
                            >

                        </div>


                        {{-- INFORMASI --}}
                        <div class="flex flex-col w-full gap-2">

                            <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm">
                                {{ $item->nama_kolaborasi }}
                            </h1>

                            <p class="font-[poppins] text-xs text-gray-500">

                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}

                                @if ($item->tanggal_mulai != $item->tanggal_selesai)
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                @endif

                            </p>

                            <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify line-clamp-3">
                                {{ $item->deskripsi_kolaborasi }}
                            </p>

                        </div>

                    </a>

                @empty

                    <div class="flex flex-col justify-center items-center w-full py-16">

                        <p class="font-[poppins] text-sm text-gray-500">
                            Tidak ada kolaborasi pada tanggal ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>



        {{-- =================================================
            SIDEBAR
        ================================================== --}}
        <div class="flex flex-col lg:w-[39%] md:w-[39%] w-full h-full gap-6 lg:order-2 md:order-2 order-1">


            {{-- =================================================
                KALENDER
            ================================================== --}}
            <div class="flex flex-col w-full bg-gray-100 rounded-lg shadow-md p-4 gap-4">


                {{-- HEADER CALENDAR --}}
                <div class="flex justify-between items-center">


                    {{-- PREVIOUS --}}
                    <button
                        wire:click="previousMonth"
                        type="button"
                        class="flex justify-center items-center w-9 h-9 rounded-full hover:bg-gray-200 transition"
                    >

                        <span class="text-lg">
                            ←
                        </span>

                    </button>


                    {{-- MONTH --}}
                    <h2 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm">

                        {{ \Carbon\Carbon::create($year, $month, 1)->translatedFormat('F Y') }}

                    </h2>


                    {{-- NEXT --}}
                    <button
                        wire:click="nextMonth"
                        type="button"
                        class="flex justify-center items-center w-9 h-9 rounded-full hover:bg-gray-200 transition"
                    >

                        <span class="text-lg">
                            →
                        </span>

                    </button>

                </div>


                {{-- KEMBALI KE BULAN SEKARANG --}}
                <button
                    wire:click="currentMonth"
                    type="button"
                    class="font-[poppins] text-xs text-gray-600 hover:text-black"
                >
                    Kembali ke bulan sekarang
                </button>


                {{-- =================================================
                    NAMA HARI
                ================================================== --}}
                <div class="grid grid-cols-7 gap-1">

                    @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day)

                        <div class="flex justify-center items-center h-8">

                            <span class="font-[poppins] font-semibold text-xs text-gray-500">
                                {{ $day }}
                            </span>

                        </div>

                    @endforeach

                </div>


                {{-- =================================================
                    TANGGAL
                ================================================== --}}
                <div class="grid grid-cols-7 gap-1">

                    @foreach ($this->calendarDays as $date)

                        @php
                            $isCurrentMonth = $date->month == $month;
                            $isSelected = $date->format('Y-m-d') == $selectedDate;
                            $isToday = $date->isToday();
                            $hasEvent = $this->hasEvent($date);
                        @endphp


                        <button
                            type="button"
                            wire:click="selectDate('{{ $date->format('Y-m-d') }}')"
                            class="
                                relative
                                flex
                                flex-col
                                justify-center
                                items-center
                                h-11
                                rounded-md
                                transition
                                duration-150

                                {{ !$isCurrentMonth ? 'text-gray-300' : 'text-black' }}

                                {{ $isSelected
                                    ? 'bg-[#9CB080] text-white'
                                    : 'hover:bg-gray-200'
                                }}
                            "
                        >

                            {{-- NOMOR TANGGAL --}}
                            <span
                                class="
                                    font-[poppins]
                                    text-xs
                                    {{ $isToday && !$isSelected ? 'font-bold underline' : '' }}
                                "
                            >
                                {{ $date->day }}
                            </span>


                            {{-- TANDA ADA KOLABORASI --}}
                            @if ($hasEvent)

                                <span
                                    class="
                                        absolute
                                        bottom-1
                                        w-1.5
                                        h-1.5
                                        rounded-full

                                        {{ $isSelected
                                            ? 'bg-white'
                                            : 'bg-[#9CB080]'
                                        }}
                                    "
                                ></span>

                            @endif

                        </button>

                    @endforeach

                </div>


                {{-- KETERANGAN --}}
                <div class="flex items-center gap-2 pt-2">

                    <span class="w-2 h-2 rounded-full bg-[#9CB080]"></span>

                    <p class="font-[poppins] text-xs text-gray-500">
                        Ada kolaborasi
                    </p>

                </div>

            </div>


            {{-- =================================================
                INFO WILAYAH
            ================================================== --}}
            <div class="flex flex-col w-full gap-2">

                <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm">
                    Wilayah
                </h1>

                <div class="border-b border-gray-300"></div>

                <div class="bg-gray-100 rounded-lg p-4 shadow-sm">

                    <p class="font-[poppins] text-sm font-semibold">
                        {{ $wilayah->nama_wilayah }}
                    </p>

                    <p class="font-[poppins] text-xs text-gray-500 mt-1">
                        {{ $kolaborasi->count() }} program kolaborasi
                    </p>

                </div>

            </div>

        </div>

    </article>

</section>