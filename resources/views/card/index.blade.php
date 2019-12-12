@if ($cards->isEmpty())
	<p>@lang('cards.noCards')</p>
@else

<div class="table-responsive">
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th class="th-sm" title="@lang('cards.heading')">@lang('cards.heading')</th>
			<th class="th-sm" title="@lang('cards.language')">@lang('cards.language')</th>
			<th class="th-sm" title="@lang('cards.definition')">@lang('cards.definition')</th>
			<th class="th-sm" title="@lang('cards.voteCount')">@lang('cards.voteCount')</th>
			<th class="th-sm" title="@lang('cards.validated')">@lang('cards.validated')</th>
			<th class="th-sm" title="@lang('cards.viewDetails')">@lang('cards.viewDetails')</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($cards as $card)
			<tr>
				<td title="{{$card->heading}}">{{$card->heading}}</td>
				<td title="{{$card->getLanguage() }}">{{$card->getLanguage()}}</td>
				<td title="{{$card->getDefinition()}}">{{$card->getDefinition()}}</td>
				<td title="{{$card->count_vote}}">{{$card->count_vote}}</td>
				<td>
					@if(isset($card->validation_id))
						<i class="fas fa-check text-success" title="@lang('cards.validated')"></i>
					@else
						<i class="fas fa-times text-danger" title="@lang('cards.notValidated')"></i>
					@endif
				</td>
				<td>
					<a href="/cards/{{$card->id}}" class="btn btn-primary">@lang('cards.viewDetails')</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
@endif

<div class="row">
	<a href="{{route('cards.create')}}" class="btn btn-primary">@lang('cards.createCard')</a>
</div>

<script src="{{ asset('js/data.js') }}"></script>
