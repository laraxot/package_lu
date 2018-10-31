{{ Theme::add('lu::css/users_list.css') }}
<div class="col-md-6">
	<!-- USERS LIST -->
	<div class="box box-danger panel panel-default">
		<div class="box-header with-border panel-heading">
			<h3 class="box-title panel-title">Latest Users Logged In</h3>
			<div class="box-tools pull-right">
				<a type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</a>
				{{--
				<span class="label label-danger">8 New Members</span>

				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
				</button>
				--}}
			</div> 
			
		</div>
		<!-- /.box-header -->
		<div class="box-body no-padding panel-body">
			<ul class="users-list clearfix">
				@foreach($row->latestUsersLoggedIn()->get() as $user)
				<li>
					<img src="{{ $user->gravatar }}" alt="User Image">
					<a class="users-list-name" href="#">&nbsp;{{ $user->last_name }} {{ $user->name }}</a>
					<span>{{ $user->handle }}</span>
					<span class="users-list-date">last at: {{ $user->last_login_at }}</span>
				</li>
				@endforeach
			</ul>
			<!-- /.users-list -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer text-center panel-footer">
			<a href="{{ $area->url }}" class="uppercase">View All Users</a>
		</div>
		<!-- /.box-footer -->
	</div>
	<!--/.box -->
</div> 