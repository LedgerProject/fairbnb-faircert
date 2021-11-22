@extends('ledger::layouts.master')
@section('content')

<!-- dashboard start here -->

<section class="ladger-section pt-3">
    <div class="container">
        <div class="row">
            <!-- right side start here -->
            <div class="list-box dynamic-listing">

                <li class="breadcrumb-item">

                    <a href="rule-listing" rel=""><span><i class="fas fa-home"></i></span></a>
                    <!--i class="fas fa-angle-right"></i-->
                </li>

                </ol>
            </div>

            <div class="col-lg-8">
                <form id="addRulesForm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="hard-rule"
                            id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Hard Rule
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="soft-rule"
                            id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Soft Rule
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="ruleFormControlInput">Rule</label>
                        <input type="text" class="form-control" id="ruleFormControlInput" placeholder="Wi-Fi enable"
                            required />
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="sorting-order" required>
                            <option>select sort order</option>
                            @foreach($order as $sort)
                            <option value="{{ $sort }} ">{{ $sort }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Add" id="add-rule" class="form-control">
                </form>
            </div>
        </div>
    </div>
</section>

<!-- dashboard ends -->
@endsection

@push('scripts')

<script>

    $(document).on('click', '#add-rule', function (e) {

        e.preventDefault();
        var rule = $('#ruleFormControlInput').val();
        var type = $('input[name="flexRadioDefault"]:checked').val();
        var sort_order = $('#sorting-order').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('ledger.rules.add') }}",
            method: "POST",
            data: {
                'rule': rule,
                'type': type,
                'sort_order': sort_order
            },
            success: function (data) {
                $('#addRulesForm')[0].reset();
                if (data) {
                    var html = '<option>select sort order</option>';
                    data.forEach(element => {
                        html += '<option value="' + element + '">' + element + '</option>';
                    });
                }
                $('#sorting-order').empty().html(html);
            }
        });
    });
</script>

    
@endpush
