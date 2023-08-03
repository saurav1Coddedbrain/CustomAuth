{{auth()->user()->name}}
{{-- <button type="submit" onclick="{{route('logout')}}" >Logout</button> --}}
<a href="{{route('logout')}}" class="btn btn-logout"> logout</a>
