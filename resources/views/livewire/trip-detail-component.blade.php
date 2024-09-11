<main>
    <div class="section">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="mb-5">
                <h2 class="mb-4" style="line-height:1.5">{{$trip->tripname}}.</h2>
                {{-- <span>15 March 2020 <span class="mx-2">/</span> </span> --}}
                <p class="list-inline-item">Category : <a href="" class="ml-1">{{$trip->category->name}} </a>
                <p class="list-inline-item">Location : <a href="" class="ml-1">{{$trip->city->name}} </a>
                </p>
                {{-- <p class="list-inline-item">Tags : <a href="" class="ml-1">Photo </a> ,<a href="#!"
                    class="ml-1">Image </a>
                </p> --}}

              </div>
              <div class="mb-5 text-center">
                <div class="post-slider rounded overflow-hidden">
                  <img loading="lazy" decoding="async" src="{{asset('storage/'.$trip->featured_img)}}" alt="Post Thumbnail">
                  
                </div>
              </div>
              <div class="content">
                @if(is_array($trip->description))
                    @foreach($trip->description as $item)
                        @if(isset($item['type']))
                            @switch($item['type'])
                                @case('title')
                                    <!-- Display title -->
                                    <h2>{{ $item['title'] ?? '' }}</h2>
                                    @break
            
                                @case('paragraph')
                                    <!-- Display paragraph -->
                                    <p>{!! nl2br(e($item['paragraph'] ?? '')) !!}</p>
                                    @break
            
                                @case('list')
                                    <!-- Display list -->
                                    <h3>{{ $item['list_title'] ?? 'List' }}</h3>
                                    @if(isset($item['list']) && is_array($item['list']))
                                        <ul>
                                            @foreach($item['list'] as $listItem)
                                                <li>{{ $listItem['list_item'] ?? '' }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    @break
            
                                @case('timeline')
                                    <!-- Display timeline -->
                                    <h3>{{ $item['timeline_title'] ?? 'Timeline' }}</h3>
                                    @if(isset($item['timeline_subtitle']))
                                        <h4>{{ $item['timeline_subtitle'] }}</h4>
                                    @endif
                                    @if(isset($item['timeline_list']) && is_array($item['timeline_list']))
                                        <ul>
                                            @foreach($item['timeline_list'] as $timelineItem)
                                                @if(isset($timelineItem['nested_items']) && is_array($timelineItem['nested_items']))
                                                    <li>
                                                        @foreach($timelineItem['nested_items'] as $nestedItem)
                                                            <p>{!! nl2br(e($nestedItem['nested_item_content'] ?? '')) !!}</p>
                                                        @endforeach
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                    @break
            
                                @default
                                    <p>Unknown type: {{ $item['type'] }}</p>
                            @endswitch
                        @endif
                    @endforeach
                @else
                    <p>{{ $service->description }}</p>
                @endif
                <br>
                {{--  ************************************************* --}}
                    <div class="block text-center text-lg-start pe-0 pe-xl-5"><a type="button"
                        class="btn btn-primary" href="{{route('booking',$trip->id)}}" data-bs-toggle="modal" data-bs-target="#applyLoan" wire:navigate>Book Now<span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span></a>
                    </div>
                {{--  **************************************************  --}}
            </div>
            
            </div>
          </div>
        </div>
      </div>
</main>
