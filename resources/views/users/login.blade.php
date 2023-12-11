<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
 
     <header class="text-center">
         <h2 class="text-2xl font-bold uppercase mb-1">
            login
         </h2>
         <p class="mb-4">login into your account to post jobs or find it </p>
     </header>
 
     <form action="/users/authenticate" method="POST">
         @csrf
      
         <div class="mb-6">
             <label for="email" class="inline-block text-lg mb-2"
                 >Email</label
             >
             <input
                 type="email"
                 class="border border-gray-200 rounded p-2 w-full"
                 name="email"
                 value="{{old('email')}}"
             />
             @error('email')
             <p class="text-red-500 text-xs mt-1">{{$message}}</p>
 
             @enderror
         </div>
 
         <div class="mb-6">
             <label
                 for="password"
                 class="inline-block text-lg mb-2"
             >
                 Password
             </label>
             <input
                 type="password"
                 class="border border-gray-200 rounded p-2 w-full"
                 name="password"
                 value="{{old('password')}}"
         
             />
             
         </div>
         <div class="mb-6">
            
             <button
                 type="submit"
                 class="bg-laravel text-white rounded py-2 px-4 hover:bg-black " style="border-radius: 0 0 30px"
             >
                 Sign In 
             </button>
         </div>
         <div class="mt-8">
            <p>
               don`t have  account?
                <a href="register" class="text-laravel"
                    >register</a
                >
            </p>
        </div>
     </form>
 </x-card>
 </x-layout>