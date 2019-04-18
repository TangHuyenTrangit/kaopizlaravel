<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
        	Trang
        </li>
        @foreach($theloai as $tl)
        <!-- kiểm tra xem thể loại có loại tin hay ko-->
        @if(count($tl->loaitin)>0)
        <li href="#" class="list-group-item menu1">
        	{{$tl->Ten}}
        </li>
        <ul>
            @foreach($tl->loaitin as $lt)
    		<li class="list-group-item">
    			<a href="#">{{$lt->Ten}}</a>
    		</li>
    		
    		
            @endforeach
        </ul>
        @endif
        @endforeach

       
    </ul>
</div>