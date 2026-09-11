<?php

use Livewire\Component;
use App\Models\News;
use App\Models\event;
use Carbon\Carbon;

new class extends Component
{
    public $news;

    public $events;

    public $selectedDate;

    public $month;

    public $year;


    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;

        // Default tanggal yang dipilih = hari ini
        $this->selectedDate = now()->format('Y-m-d');

        $this->loadNews();
        $this->loadEvents();
    }


    /*
    |--------------------------------------------------------------------------
    | NEWS
    |--------------------------------------------------------------------------
    */

    public function loadNews()
    {
        $this->news = News::where('is_active', true)
            ->orderByDesc('tanggal_publish')
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | EVENT
    |--------------------------------------------------------------------------
    */

    public function loadEvents()
    {
        $this->events = event::orderBy('tanggal')
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | PILIH TANGGAL
    |--------------------------------------------------------------------------
    */

    public function selectDate($date)
    {
        $this->selectedDate = $date;
    }


    /*
    |--------------------------------------------------------------------------
    | EVENT BERDASARKAN TANGGAL
    |--------------------------------------------------------------------------
    */

    public function getSelectedEventsProperty()
    {
        if (!$this->selectedDate) {
            return collect();
        }

        $selected = Carbon::parse($this->selectedDate);

        return $this->events->filter(function ($item) use ($selected) {

            return Carbon::parse($item->tanggal)->isSameDay($selected);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | CEK APAKAH ADA EVENT
    |--------------------------------------------------------------------------
    */

    public function hasEvent($date)
    {
        return $this->events->contains(function ($item) use ($date) {

            return Carbon::parse($item->tanggal)->isSameDay($date);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | KALENDER
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

        // Kalender dimulai Senin
        $start = $firstDay->copy()->startOfWeek(Carbon::MONDAY);

        // Kalender berakhir Minggu
        $end = $lastDay->copy()->endOfWeek(Carbon::SUNDAY);

        $days = [];

        while ($start->lte($end)) {

            $days[] = $start->copy();

            $start->addDay();
        }

        return $days;
    }

    /*
    |--------------------------------------------------------------------------
    | BULAN SEBELUMNYA
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

    /*
    |--------------------------------------------------------------------------
    | BULAN BERIKUTNYA
    |--------------------------------------------------------------------------
    */

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
    | KEMBALI KE BULAN SEKARANG
    |--------------------------------------------------------------------------
    */

    public function currentMonth()
    {
        $this->month = now()->month;
        $this->year = now()->year;

        $this->selectedDate = now()->format('Y-m-d');
    }


    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'News'
            ]);
    }
};
?>

<section class="w-full h-full flex flex-col justify-center items-center py-6 gap-6">

    {{-- =====================================================
        HEADER
    ====================================================== --}}
    <article class="flex flex-col w-[90%] h-full gap-2">

        <h1 class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">
            Berita
        </h1>

        <div class="border border-b-gray-300"></div>

    </article>


    {{-- =====================================================
        CONTENT
    ====================================================== --}}
    <article class="flex flex-wrap justify-center w-[90%] h-full gap-6">


        {{-- =================================================
            NEWS
        ================================================== --}}
        <div class="flex flex-col lg:w-[58%] md:w-[58%] w-full h-full gap-6 lg:order-1 md:order-1 order-2">

            <div class="flex flex-col w-full h-full gap-6">

                @forelse ($news as $item)

                    @php

                        /*
                        |--------------------------------------------------
                        | Ambil gambar news
                        |--------------------------------------------------
                        */

                        $newsImage = null;

                        if ($item->image) {

                            $decodedImage = json_decode($item->image, true);

                            if (is_array($decodedImage)) {
                                $newsImage = $decodedImage[0] ?? null;
                            } else {
                                $newsImage = $item->image;
                            }

                        }

                    @endphp


                    <a
                        href="{{ route('detail-news', $item->id) }}"
                        class="flex w-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-[1.01] transition-transform duration-120 ease-in-out"
                    >

                        {{-- IMAGE --}}
                        <div class="flex lg:w-90 md:w-80 w-60 lg:h-40 md:h-30 h-20 shrink-0 bg-gray-300 rounded-lg overflow-hidden">

                            @if ($newsImage)

                                <img
                                    src="{{ asset('storage/' . $newsImage) }}"
                                    alt="{{ $item->name }}"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                <div class="w-full h-full rounded-md animate-pulse">
                                </div>

                            @endif

                        </div>


                        {{-- INFORMATION --}}
                        <div class="flex flex-col w-full h-full gap-2">

                            <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">

                                {{ $item->name }}

                            </h1>


                            <p class="font-[poppins] text-xs text-gray-500">

                                {{ \Carbon\Carbon::parse($item->tanggal_publish)->translatedFormat('d F Y') }}

                            </p>


                            <p class="font-[poppins] lg:text-base md:text-sm text-xs text-justify lg:line-clamp-0 md:line-clamp-0 line-clamp-3">

                                {{ $item->isi_berita }}

                            </p>

                        </div>

                    </a>

                @empty

                    <div class="flex justify-center items-center w-full py-20">

                        <p class="font-[poppins] text-sm text-gray-500">
                            Belum ada berita.
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
                        type="button"
                        wire:click="previousMonth"
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
                        type="button"
                        wire:click="nextMonth"
                        class="flex justify-center items-center w-9 h-9 rounded-full hover:bg-gray-200 transition"
                    >
                        <span class="text-lg">
                            →
                        </span>
                    </button>

                </div>


                {{-- CURRENT MONTH --}}
                <button
                    type="button"
                    wire:click="currentMonth"
                    class="font-[poppins] text-xs text-gray-500 hover:text-black"
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

                            $isSelected =
                                $date->format('Y-m-d') == $selectedDate;

                            $isToday =
                                $date->isToday();

                            $hasEvent =
                                $this->hasEvent($date);

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

                                {{ !$isCurrentMonth
                                    ? 'text-gray-300'
                                    : 'text-black'
                                }}

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

                                    {{ $isToday && !$isSelected
                                        ? 'font-bold underline'
                                        : ''
                                    }}
                                "
                            >
                                {{ $date->day }}
                            </span>


                            {{-- TANDA EVENT --}}
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
                        Ada event
                    </p>

                </div>

            </div>



            {{-- =================================================
                EVENTS
            ================================================== --}}
            <div class="lg:flex md:flex flex-col w-full h-full gap-4">

                <div class="flex flex-col w-[90%] gap-2">

                    <h1 class="font-[poppins] font-semibold lg:text-lg md:text-base text-sm normal-case">

                        Event

                    </h1>

                    <div class="border border-b-gray-300"></div>

                </div>


                {{-- TANGGAL TERPILIH --}}
                <div class="flex flex-col gap-1">

                    <p class="font-[poppins] text-xs text-gray-500">
                        Event pada tanggal
                    </p>

                    <p class="font-[poppins] font-semibold text-sm">

                        {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}

                    </p>

                </div>


                {{-- =================================================
                    EVENT SESUAI TANGGAL
                ================================================== --}}
                <div class="flex flex-col w-full h-full gap-6">

                    @forelse ($this->selectedEvents as $item)

                        <a
                            href="{{ route('detail-event', $item->id) }}"
                            class="flex w-full gap-4 bg-gray-100 rounded-lg shadow-md p-4 hover:scale-[1.01] transition-transform duration-120 ease-in-out"
                        >

                            {{-- IMAGE --}}
                            <div class="flex lg:w-48 md:w-40 w-32 lg:h-20 md:h-16 h-12 shrink-0 bg-gray-300 rounded-lg overflow-hidden">

                                @if ($item->gambar)

                                    <img
                                        src="{{ asset('storage/' . $item->gambar) }}"
                                        alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover"
                                    >

                                @else

                                    <div class="w-full h-full rounded-md animate-pulse">
                                    </div>

                                @endif

                            </div>


                            {{-- INFORMATION --}}
                            <div class="flex flex-col w-full h-full gap-2">

                                <h1 class="font-[poppins] font-semibold lg:text-base md:text-sm text-xs normal-case">

                                    {{ $item->judul }}

                                </h1>


                                <p class="font-[poppins] text-xs text-gray-500">

                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                                </p>


                                <p class="font-[poppins] lg:text-sm md:text-xs text-xs text-justify line-clamp-3">

                                    {{ $item->deskripsi }}

                                </p>

                            </div>

                        </a>

                    @empty

                        <div class="flex flex-col justify-center items-center w-full py-10">

                            <p class="font-[poppins] text-xs text-gray-500 text-center">

                                Tidak ada event pada tanggal ini.

                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </article>

</section>