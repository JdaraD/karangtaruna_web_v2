<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="relative select-none bottom-0 bg-black w-full">
    {{-- infomasi --}}
    <div class="flex justify-center items-center align-content-center w-full h-full">
        <div class="grid grid-cols-3 h-full py-2 lg:gap-4 md:gap-4 gap-2 size-[94%]">

            <div class="flex flex-col gap-2 h-full">
                    
                <div class="flex row-span-1 items-center gap-2">
                    {{-- logo Start --}}
                    <img src="{{ asset('img/logo.png') }}" alt="" class="lg:w-16 lg:h-16 md:w-14 md:h-14 w-12 h-12 rounded-full">
                    {{-- logo Ends --}}

                    {{-- identity name --}}
                    <div>
                        <p class="font-[poppins] font-medium lg:text-sm md:text-sm text-[10px] text-white normal-case">Karang Taruna</p>
                        <p class="font-[poppins] font-medium lg:text-xs md:text-[10px] text-[8px] text-white normal-case">Desa Waru</p>
                    </div>
                    {{-- identity name --}}
                    
                </div>
                
                {{-- Deskripsi --}}
                <div class="row-span-3 h-full">
                    
                    <p class="pb-2 lg:text-sm md:text-sm text-[10px] font-[poppins] font-semibold text-white normal-case">Deskripsi</p>
                    <p class="lg:text-xs md:text-[10px] text-[8px] font-[poppins] text-justify text-white lg:line-clamp-9 md:line-clamp-9 line-clamp-5 normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime, molestias. Nulla rerum, facilis officiis quaerat, voluptate et cumque, ea perspiciatis ipsa mollitia consequatur similique alias? Qui animi odio assumenda corrupti.</p>
                    <a href="#" class="lg:text-xs md:text-[10px] text-[8px] font-[poppins] text-justify text-white hover:text-blue-300 normal-case">Selengkapnya...</a>
                    
                </div>
                {{-- Deskripsi --}}
                
            </div>

            <div class="h-full" id="kontak">

                <div class="flex h-[10%] justify-center items-center">
                    <p class="lg:text-sm md:text-sm text-xs font-[poppins] font-medium text-white normal-case">Kontak</p>
                </div>
                <div class="h-[90%]">

                    {{-- address --}}
                    <p class="lg:text-xs md:text-[10px] text-[8px] font-[poppins] font-medium text-white normal-case text-justify pb-4">Desa waru jln yang mana aja</p>
                    {{-- address --}}

                    {{-- icons 1 --}}
                    <div class="flex gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="lg:size-5 md:size-5 size-3" fill="white">
                            <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"/>
                        </svg>
                        <address class="lg:text-xs md:text-[10px] text-[8px] font-[poppins] font-medium text-white">00823213123</address>

                    </div>
                    {{-- icons 1 --}}

                    {{-- icons 2 --}}
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="lg:size-5 md:size-5 size-3" fill="white">
                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                        </svg>
                        <address class="lg:text-xs md:text-[10px] text-[8px] font-[poppins] font-medium text-white">info@karangtaruna.com</address>

                    </div>
                    {{-- icons 2 --}}
                </div>    

            </div>

            <div class="h-full">

                <div class="flex h-[10%] justify-center items-center">
                    <p class="lg:text-sm md:text-sm text-xs font-[poppins] font-medium text-white normal-case">Bantuan</p>
                </div>

                <div>
                    <div class="h-[90%]">
                        {{-- icons 1 --}}
                        <div class="flex gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="lg:size-5 md:size-5 size-3" fill="white">
                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
                            </svg>
                            
                            <div class="flex gap-2">
                                <p class="lg:text-xs md:text-xs text-[8px] font-[poppins] font-medium normal-case text-white">ahmad :</p>
                                <address class="lg:text-xs md:text-xs text-[8px] font-[poppins] font-medium normal-case text-white">08123456789</address>
                            </div>
                            
                        </div>
                        {{-- icons 1 --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- infomasi --}}

    {{-- copyright --}}
    <div class=" text-center py-2 text-xs flex justify-center items-center gap-2">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-4 h-4">
        <p class="font-[poppins] font-medium lg:text-sm md:text-[10px] text-[8px] text-white normal-case">Copyright &copy; {{ date('Y') }} Karang Taruna Desa Waru. All rights reserved.</p>
    </div>
        
    {{-- copyright --}}
</div>