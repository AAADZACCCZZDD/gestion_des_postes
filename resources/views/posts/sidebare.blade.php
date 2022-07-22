<div class="card mt-5 ">
    <div class="card-body">
        <h4>Most Post Commented</h4>
        <ul class="list-group list-group-flush">
            @foreach ($MostPostCommented as $MPC)
                <li class="list-group-item">
                    {{-- <p></p> --}}
                    * {{ $MPC->title }}
                    <span class="badge bg-secondary">{{ $MPC->comment_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card mt-5">
    <div class="card-body">
        <h4>Most User Posted</h4>
        <ul class="list-group list-group-flush">
            @foreach ($MostUserPosted as $MUP)
                <li class="list-group-item">
                    * {{ $MUP->name }}
                    <span class="badge bg-secondary">{{ $MUP->post_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="card mt-5">
    <div class="card-body">
        <h4>Users Active Last Month</h4>
        <ul class="list-group list-group-flush">
            @foreach ($UsersActiveLastMonth as $UALM)
                <li class="list-group-item">
                    * {{ $UALM->name }}
                    <span class="badge bg-secondary">{{ $UALM->post_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>