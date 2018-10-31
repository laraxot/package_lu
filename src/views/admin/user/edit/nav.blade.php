<div class="btn-group">
<a href="{{route('lu.user.index',$params)}}" class="btn btn-small btn-default"  data-toggle="tooltip" title="Back" >
<i class="fa fa-step-backward" aria-hidden="true"></i>&nbsp;</a>

<a href="{{route('lu.user.area.index',$params)}}" class="btn btn-small btn-default {{ (Request::is('*/area') ? 'active' : '') }}"  data-toggle="tooltip" title="Aree Utente" >
<i class="fa fa-link fa-fw" aria-hidden="true"></i>&nbsp;</a>

<a href="{{route('lu.user.group.index',$params)}}" class="btn btn-small btn-default {{ (Request::is('*/group') ? 'active' : '') }}"  data-toggle="tooltip" title="Gruppi Utente" >
<i class="fa fa-users fa-fw" aria-hidden="true"></i>&nbsp;</a>

<a href="{{route('lu.user.right.index',$params)}}" class="btn btn-small btn-default {{ (Request::is('*/right') ? 'active' : '') }}"  data-toggle="tooltip" title="Diritti Utente" >
<i class="fa fa-university" aria-hidden="true"></i>&nbsp;</a>


<a href="{{route('lu.user.permuser.index',$params)}}" class="btn btn-small btn-default {{ (Request::is('*/permuser') ? 'active' : '') }}"  data-toggle="tooltip" title="Livello Utente">
<i class="fa fa-level-up fa-fw" aria-hidden="true"></i>&nbsp;</a>

</div>