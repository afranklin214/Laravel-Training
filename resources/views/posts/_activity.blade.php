<div class="container">
    <div class="row">

        <x-card title="Most Commented" subtitle="What people are currently talking about">
            @slot('items')
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach 
            @endslot
        </x-card>  


        {{-- <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Most Commented</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    What people are currently talking about
                </h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostCommented as $post)
                    <li class="list-group-item">
                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                            {{ $post->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div> --}}
    </div>

    <div class="row mt-4">
        {{-- <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Most Active</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                        Users with most posts written
                </h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostActive as $user)
                    <li class="list-group-item">
                        {{  $user->name }}
                    </li>
                    @endforeach
            </ul>
        </div> --}}

        <x-card title="Most Active" subtitle="Writers with most posts written">
            @slot('items', collect($mostActive)->pluck('name'))    
        </x-card>  

    </div>

    <div class="row mt-4">

        <x-card title="Most Active Last Month" subtitle="Users with most posts written in the last month">
            @slot('items', collect($mostActiveLastMonth)->pluck('name'))    
        </x-card>  

        {{-- <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Most Active Last Month</h5>
                <h6 class="card-subtitle mb-2 text-muted">
                        Users with most posts written in the last month
                </h6>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostActiveLastMonth as $user)
                    <li class="list-group-item">
                        {{  $user->name }}
                    </li>
                    @endforeach
            </ul>
        </div> --}}
       
    </div>
</div>