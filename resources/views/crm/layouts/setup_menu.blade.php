<div class="list-group">
    <a href="{{ route('cms') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'cms' ? 'active' : '' }}">
        CMS
      </a>
    <a href="{{ route('users') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'users' ? 'active' : '' }}">
      Users
    </a>
    <a href="{{ route('roles') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
        Roles</a>
    <a href="#" class="list-group-item list-group-item-action {{ Request::segment(2) == 'teams' ? 'active' : '' }}">
        Teams</a>
    <a href="#" class="list-group-item list-group-item-action {{ Request::segment(2) == 'organizations' ? 'active' : '' }}">
        Organizations</a>
    <a href="{{ route('country') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'country' ? 'active' : '' }}">
        Country</a>
    <a href="{{ route('leadsource') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'leadsource' ? 'active' : '' }}">
        Lead Source</a>
    <a href="{{ route('leadtype') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'leadtype' ? 'active' : '' }}">
        Lead Type</a>
    <a href="{{ route('dealstages') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'dealstages' ? 'active' : '' }}">
        Deal Stages</a>
    <a href="#" class="list-group-item list-group-item-action {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
        Permission</a>
    <a href="{{ route('pagetype') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'pagetype' ? 'active' : '' }}">
        Page Type</a>
    <a href="{{ route('subscriptions') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}">
        Subcriptions
        </a>
    <a href="{{ route('company') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'company' ? 'active' : '' }}">
        Company
    </a>
    <a href="{{ route('company-subscriptions') }}" class="list-group-item list-group-item-action {{ Request::segment(2) == 'company-subscriptions' ? 'active' : '' }}">
        Company Subcriptions
        </a>
        {{-- <a href="javascipt:void(0);" data-id="cms" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'cms' ? 'active' : '' }}">
            CMS
          </a>
        <a href="javascipt:void(0);" data-id="users" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'users' ? 'active' : '' }}">
          Users
        </a>
        <a href="javascipt:void(0);" data-id="roles" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
            Roles</a>
        <a href="javascipt:void(0);" data-id="teams" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'teams' ? 'active' : '' }}">
            Teams</a>
        <a href="javascipt:void(0);" data-id="organizations" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'organizations' ? 'active' : '' }}">
            Organizations</a>
        <a href="javascipt:void(0);" data-id="country" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'country' ? 'active' : '' }}">
            Country</a>
        <a href="javascipt:void(0);" data-id="leadsource" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'leadsource' ? 'active' : '' }}">
            Lead Source</a>
        <a href="javascipt:void(0);" data-id="leadtype" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'leadtype' ? 'active' : '' }}">
            Lead Type</a>
        <a href="javascipt:void(0);" data-id="dealstages" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'dealstages' ? 'active' : '' }}">
            Deal Stages</a>
        <a href="#" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
            Permission</a>
        <a href="javascipt:void(0);" data-id="pagetype" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'pagetype' ? 'active' : '' }}">
            Page Type</a>
        <a href="javascipt:void(0);" data-id="subscriptions" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'subscriptions' ? 'active' : '' }}">
            Subcriptions
            </a>
        <a href="javascipt:void(0)" data-id="company" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'company' ? 'active' : '' }}">
            Company
        </a>
        <a href="javascipt:void(0)" data-id="company-subscriptions" class="inner-menu list-group-item list-group-item-action {{ Request::segment(2) == 'company-subscriptions' ? 'active' : '' }}">
            Company Subcriptions
            </a> --}}
</div>



