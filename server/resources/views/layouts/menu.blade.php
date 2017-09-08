<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('cars*') ? 'active' : '' }}">
    <a href="{!! route('cars.index') !!}"><i class="fa fa-edit"></i><span>Cars</span></a>
</li>

