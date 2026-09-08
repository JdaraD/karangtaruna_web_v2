<?php

use Livewire\Component;
use App\Models\identity;
use App\Models\product;
use App\Models\kegiatan;
use App\Models\kolaborasi;
use App\Models\Visitor;
use App\Models\tentang;
use Carbon\Carbon;


new class extends Component
{
    public $identity, $product, $kegiatan, $kolaborasi, $todayVisitors, $totalVisitors, $tentang;

    // load data
    public function loadIdentity()
    {
        $this->identity = identity::latest()->take(1)->get();
    }

    public function countProduct()
    {
        $this->product = product::count();
    }

    public function countKegiatan()
    {
        $this->kegiatan = kegiatan::count();
    }

    public function countKolaborasi()
    {
        $this->kolaborasi = kolaborasi::count();
    }

        public function loadTentang()
    {
        $this->tentang = tentang::latest()
            ->take(1)
            ->get();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadIdentity();
        $this->countProduct();
        $this->countKegiatan();
        $this->countKolaborasi();
        $this->loadTentang();

        // Gunakan helper request() untuk mengambil IP di dalam Livewire
        $ipAddress = request()->ip(); 
        
        // UNTUK TESTING LOKAL: Buka komentar di bawah ini agar data bertambah
        // $ipAddress = rand(1,255) . '.' . rand(1,255) . '.1.1';

        $today = Carbon::now()->toDateString();

        // Cek dan simpan pengunjung menggunakan method bawaan model (query)
        $hasVisited = Visitor::query()
            ->where('ip_address', $ipAddress)
            ->where('visit_date', $today)
            ->exists();

        if (!$hasVisited) {
            Visitor::query()->create([
                'ip_address' => $ipAddress,
                'visit_date' => $today
            ]);
        }

        // Set variabel public agar bisa dibaca oleh view
        $this->totalVisitors = Visitor::query()->count();
        $this->todayVisitors = Visitor::query()->where('visit_date', $today)->count();
    }
    // function mount

    // function Button
    // function Button

    // add function
    // add function

    // update function
    // update function

    // delete function
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin',[
                'title' => 'Dashboard'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">

    <article class="flex flex-none gap-2 items-center">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base ">Dashboard</h1>
    </article>

    <article class="flex flex-none gap-4 items-center justify-between w-full">
        <div class="flex justify-between items-center w-full lg:h-24 md:h-18 h-14 px-4 bg-white rounded-md shadow-md">
                <div class="flex gap-8">
                    <div>
                        <h4 class="text-gray-500 text-sm">Pengunjung Hari Ini</h4>
                        <p class="text-2xl font-bold text-blue-600">{{ $todayVisitors }}</p>
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-sm">Total Pengunjung</h4>
                        <p class="text-2xl font-bold text-emerald-600">{{ $totalVisitors }}</p>
                    </div>
                </div>
        </div>

        <div class="flex justify-between items-center w-full lg:h-24 md:h-18 h-14 px-4 bg-white rounded-md shadow-md">
            <p class="lg:text-xl md:text-base text-sm font-semibold text-black">Usaha Mandiri : {{ $product }}</p>
            <a href="{{ route('admin.usaha') }}" class="flex justify-center items-center">
                <x-gmdi-business-center class="h-10 w-10 text-black " />
            </a>
        </div>

        <div class="flex justify-between items-center w-full lg:h-24 md:h-18 h-14 px-4 bg-white rounded-md shadow-md">
            <p class="lg:text-xl md:text-base text-sm font-semibold text-black">Kegiatan : {{ $kegiatan }}</p>
            <a href="{{ route('admin.kegiatan') }}" class="flex justify-center items-center">
                <x-bi-activity class="h-10 w-10 text-black"/>
            </a>
        </div>
        <div class="flex justify-between items-center w-full lg:h-24 md:h-18 h-14 px-4 bg-white rounded-md shadow-md">
            <p class="lg:text-xl md:text-base text-sm font-semibold text-black">Kolaborasi : {{ $kolaborasi }}</p>
            <a href="{{ route('admin.kolaborasi') }}" class="flex justify-center items-center">
                <x-iconpark-cooperativehandshake-o class="h-10 w-10 text-black"/>
            </a>
        </div>
    </article>

    <article class="flex flex-none gap-4 items-center w-full">
        <div class="flex flex-col justify-stretch items-center lg:w-[36%] w-full gap-2 lg:h-80 h-auto p-4 bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Identitas</h1>
                </div>
            </div>
            @foreach ($identity as $it )
                <div class="flex justify-center items-center">
                    <img src="{{ asset('storage/'. $it->image) }}" alt="" class="w-40 h-42 rounded-md object-cover">
                </div>
                <div class="flex flex-col items-center">
                    <div class="flex items-center gap-1">
                        <h1 class="font-semibold capitalize lg:text-lg md:text-base text-base text-black">Nama Organiasi :</h1>
                        <p class="lg:text-base text-sm text-black">{{ $it->name }}</p>
                    </div>

                    <div class="flex items-center gap-1">
                        <h1 class="font-semibold capitalize lg:text-base text-sm text-black">Periode : </h1>
                        <p class="lg:text-sm text-xs text-black"> {{ $it->periode }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex flex-col justify-stretch items-center  w-[64%] gap-2 lg:min-h-80 bg-white rounded-md shadow-md p-6">
            
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                @foreach ($tentang as $te )  
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="lg:text-base text-sm text-black capitalize">{{ $te->name }}</h1>
                </div>
                @endforeach
            </div>
            @foreach ($tentang as $te )
            <div class="flex flex-wrap">
                <p class="lg:text-base text-sm lg:line-clamp-9 md:line-clamp-8 line-clamp-5 text-black text-justify">{{ $te->isi }}</p>

            </div>
            @endforeach

        </div>
        
    </article>

    <article class="flex w-full h-auto p-4 overflow-hidden bg-white rounded-md shadow-md items-center">
        <!-- Container untuk Horizontal Scroll -->
        <div class="flex items-center gap-8 w-300 py-2 overflow-x-auto scrollbar-none">
            
            @for ($i = 1; $i <= 12; $i++)
                <div class="shrink-0 flex items-center justify-center w-32 h-16 bg-gray-50 rounded border border-gray-100 p-2">
                    <span class="text-gray-400 font-bold text-sm tracking-wider">LOGO {{$i}}</span>
                </div>
                
            @endfor

        </div>
    </article>

</section>
