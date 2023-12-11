

<x-card>
    
    <div class="flex">
        <img
            class="hidden w-48 mr-6 pl-8 md:block " style="border-radius: 0 0 50px;"
            src="{{$listing->logo ? asset('storage/'.$listing->logo) : asset('/images/no_image.png')}}"

            alt=""
            
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$listing->id}}">{{$listing->title}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{$listing->company}}</div>
           <x-listing-tags :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{$listing->location}}
                
            </div>
        </div>
    </div>
</x-card>