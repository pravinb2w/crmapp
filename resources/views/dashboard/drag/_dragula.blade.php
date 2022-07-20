<ul id="sortable" class="row  p-0">
    @foreach ($sortable[0] as $key => $order)
        @if ($order == 'sortable-1')
            <li id="sortable-1" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title mb-0 me-3">
                            My Task
                            <span onclick="change_view_length('sortable-1')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <span class="mdi mdi-drag"></span>
                    </div>
                    @include('dashboard._task_tab')
                </div>
            </li>
        @endif
        @if ($order == 'sortable-2')
            <li id="sortable-2" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h4 class="header-title mb-0 me-3">
                            Closing of the Week
                            <span onclick="change_view_length('sortable-2')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h4>
                        <div class="x-y d-center">
                            <select name="close_week_type" id="close_week_type" class="bar-select">
                                <option value="">-select -</option>
                                <option value="planned"> Planned</option>
                                <option value="done"> Done </option>
                            </select>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('dashboard._close_week')
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-3')
            <li id="sortable-3" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title mb-0 me-3">
                            All Task
                            <span onclick="change_view_length('sortable-3')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="xy d-center">
                            <select name="" id="" class="bar-select">
                                <option value="">All</option>
                                <option value="">Overdue</option>
                                <option value="">Recent</option>
                                <option value="">Overdue</option>
                                <option value="">Cancelled</option>
                            </select>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    @include('dashboard._all_task_tab')
                </div>
            </li>
        @endif
        @if ($order == 'sortable-4')
            <li id="sortable-4" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">
                            Planned vs Done
                            <span onclick="change_view_length('sortable-4')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <select name="from_type" id="from_type" class="bar-select">
                                <option value="">All</option>
                                <option value="lead">Leads</option>
                                <option value="deal"> Collection</option>
                                <option value="task"> Tasks </option>
                            </select>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="planned_done">
                            @include('dashboard._planned_done')
                        </div>
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-5')
            <li id="sortable-5" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">Deals Started
                            <span onclick="change_view_length('sortable-5')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <small class="muted">This Year</small>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-6')
            <li id="sortable-6" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">
                            Overall Collections
                            <span onclick="change_view_length('sortable-6')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <small class="muted">This Year</small>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body p-0" style="overflow: hidden">
                        <div id="myChart-pie" style="width:100%;height:300px;transform:scale(1.1)"></div>
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-7')
            <li id="sortable-7" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">
                            Deals Won over time
                            <span onclick="change_view_length('sortable-7')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <small class="muted">This Year</small>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart-deals-won" style="width:100%;max-width:100%"></canvas>
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-8')
            <li id="sortable-8" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">
                            Deals progress
                            <span onclick="change_view_length('sortable-8')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <select name="deal_stages" id="deal_stages" class="bar-select">
                                <option value="">All</option>
                                @if (isset($deal_stages) && !empty($deal_stages))
                                    @foreach ($deal_stages as $item)
                                        <option value="{{ $item->id }}"> {{ $item->stages }}</option>
                                    @endforeach
                                @endif

                            </select>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('dashboard._deal_progress')
                    </div>
                </div>
            </li>
        @endif
        @if ($order == 'sortable-9')
            <li id="sortable-9" class="{{ $sortable[1][$key] }} p-1">
                <div class="card">
                    <div class="card-header">
                        <h3 class="header-title">
                            Deals Conversion
                            <span onclick="change_view_length('sortable-9')"
                                class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        </h3>
                        <div class="x-y d-center">
                            <small class="muted">This Year</small>
                            <span class="mdi mdi-drag"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart-deals-conversion" style="width:100%;max-width:100%"></canvas>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
</ul>
