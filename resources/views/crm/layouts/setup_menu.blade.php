<div class="list-group">
    
    <a href="{{ route('users') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'users' ? 'active' : '' }}">
      Users
    </a>
    <a href="{{ route('roles') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
        Roles</a>
    <a href="{{ route('permissions') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
        Permission</a>
    {{-- <a href="{{ route('tax') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'tax' ? 'active' : '' }}">
            Tax Groups</a> --}}
    <a href="{{ route('activity-status') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'activity-status' ? 'active' : '' }}">
        Activity Status</a>
    <a href="{{ route('task-status') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'task-status' ? 'active' : '' }}">
        Task Status</a>
    <a href="{{ route('teams') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'teams' ? 'active' : '' }}">
        Teams</a>
    
    <a href="{{ route('country') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'country' ? 'active' : '' }}">
        Country</a>
    @if (Auth::user()->is_dev)
        {{-- <a href="{{ route('pagetype') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'pagetype' ? 'active' : '' }}">
            Page Type</a> --}}
        <a href="{{ route('subscriptions') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}">
            Subcriptions
            </a>
        {{-- <a href="{{ route('company') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'company' ? 'active' : '' }}">
            Company
        </a> --}}
        <a href="{{ route('company-subscriptions') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'company-subscriptions' ? 'active' : '' }}">
            Company Subcriptions
            </a>
    @endif
        
</div>



