{{ Theme::add('lu::css/users_list.css') }}
<div class="col-md-6">
@component('adm_theme::layouts.components.blade.widget')
@slot('title')
	Latest Users Logged In
@endslot
@slot('body')
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
@endslot
@slot('footer')
	<a href="{{ $area->url }}" class="uppercase">View All Users</a>
@endslot
@endcomponent
</div>
