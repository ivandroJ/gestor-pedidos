 <nav class="bg-blue-400 shadow-md fixed w-full top-0 z-50 border-b-2">
     <div class="container mx-auto px-4 py-3 flex justify-between items-center">

         <a href="/" class=" text-xl font-bold text-white">{{ config('app.name', 'Laravel') }}</a>

         <!-- Links da Navbar (Desktop) -->
         <div class=" md:flex space-x-4 text-center">
             <a href="#" class="text-white">{{ Auth::user()->nome }}
                 ({{ Auth::user()->perfil }})
             </a>
             <form action="/logout" method="POST" onsubmit="return confirm('Tem certeza?')">
                 @csrf
                 <x-button color="red" color_tone='600' class="text-sm" type='submit' py="1" px="3">
                     <i class="fas fa-sign-out"></i>
                     Sair
                 </x-button>

             </form>
         </div>
     </div>
 </nav>
