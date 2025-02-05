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
                 <button href="/logout"
                     class="w-full bg-red-600 text-white  px-3 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                     <i class="fas fa-sign-out"></i>
                     Sair</button>
             </form>
         </div>
     </div>
 </nav>
