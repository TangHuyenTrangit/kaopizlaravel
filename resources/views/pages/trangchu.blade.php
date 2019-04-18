 @extends('layout.index')
 @section('content')
  <div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
          @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức của Tam Mao</h2>
	            	</div>

	            	<div class="panel-body">
	            		@foreach( $theloai as $tl)
					    <div class="row-item row">
		                	<h3>
		                		<a href="category.html">{{ $tl->Ten }}</a>  
		                		@foreach($tl -> loaitin as $lt)	
		                		@if(count($tl->loaitin)>0)
		                		<small><a href="category.html"><i>{{ $lt->Ten }}</i></a>/</small>
		                		@endif
		                		@endforeach
		                	</h3>
		                	
		                	<?php
		                	$data = $lt->tintuc->where('NoiBat', 1 )->sortByDesc('created_at')->take(5);
		                	//Lấy ra 1 tin.còn lại trong cơ sở dữ liệu sẽ còn n-1 tin để trả về phía bên tin còn lại
		                	$tin1 = $data->shift();


		                	?>
							<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="detail.html">
			                         <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt=""> 
			                        </a>	
			                    </div>

			                    <div class="col-md-7">
			                        <h3>Project Five</h3>
			                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, quo, minima, inventore voluptatum saepe quos nostrum provident .</p>
			                        <a class="btn btn-primary" href="detail.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>
		                    

							<div class="col-md-4">
								<a href="detail.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									</h4>
								</a>

								<a href="detail.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									</h4>
								</a>

								<a href="detail.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									</h4>
								</a>

								<a href="detail.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit.
									</h4>
								</a>
							</div>
							
							<div class="break"></div>
		                </div>
		                @endforeach

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
  @endsection