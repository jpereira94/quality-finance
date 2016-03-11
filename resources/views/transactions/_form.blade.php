<div class="row">
    <div class="input-field col s4">
        {!! Form::text('invoice_number', null) !!}
        {!! Form::label('invoice_number', 'Número da fatura') !!}
    </div>


    <div class="input-field col s4">
        <?php
            $attr['class'] = 'datepicker';
            if (Form::getValueAttribute('transaction_date') != '')
                $attr['data-value'] = Form::getValueAttribute('transaction_date')->toDateString();
        ?>
        {!! Form::input('date', 'transaction_date', null, $attr) !!}
        {!! Form::label('transaction_date', 'Data Emissão', ['class' => 'active']) !!}
    </div>

    <div class="input-field col s4">
        <?php
            unset($attr);
        $attr['class'] = 'datepicker';
        if (Form::getValueAttribute('payment_date') != '')
            $attr['data-value'] = Form::getValueAttribute('payment_date')->toDateString();
        ?>
        {!! Form::input('date', 'payment_date', null, $attr) !!}
        {!! Form::label('payment_date', 'Data Pagamento', ['class' => 'active']) !!}
    </div>

    <div class="input-field col s6">
            <select name="company_id" id="company_id">
                <option value=""></option>
                @foreach($companies as $company_id => $company)
                    <option value="{{ $company_id }}" @if(Form::getValueAttribute('company_id') == $company_id) selected="selected" @endif >{{ $company }}</option>
                @endforeach
            </select>
            {!! Form::label('company_id', 'Entidade') !!}
    </div>

    <div class="input-field col s6">
        <select name="account_id" id="account_id">
            <option value=""></option>

            @foreach($accounts as $account_id => $account)
                <option value="{{ $account_id }}" @if(Form::getValueAttribute('account_id') == $account_id) selected="selected" @endif >{{ $account }}</option>
            @endforeach

        </select>
        {!! Form::label('account_id', 'Conta') !!}
    </div>

    <div class="input-field col s6">
        <select name="category_id" id="category_id">
            <option value=""></option>

            @foreach($categories as $category)
                <optgroup label="{{ $category->name }}">
                    <option value="{{ $category->id }}" @if(Form::getValueAttribute('category_id') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                    @foreach($category->Child as $category_child)
                        <option value="{{ $category_child->id }}" @if(Form::getValueAttribute('category_id') == $category_child->id) selected="selected" @endif>{{ $category_child->compound_name }}</option>
                    @endforeach
                </optgroup>
            @endforeach
        </select>
        {!! Form::label('category_id', 'Categoria') !!}
    </div>

    </div>
<div class="row">
    <div class="input-field col s4">
        {!! Form::text('amount', null) !!}
        {!! Form::label('amount', 'Quantia (€)') !!}
    </div>
    <div class="input-field col s4">
        {!! Form::text('tax', null) !!}
        {!! Form::label('tax', 'Imposto (€)') !!}
    </div>
    <div class="input-field col s4">
        <div class="switch">
            <label>
                Despesa
                <input type="checkbox" name="is_expense" value="0" @if(Form::getValueAttribute('is_expense') === 0) checked="checked" @endif>
                <span class="lever"></span>
                Receita
            </label>
        </div>
    </div>

    <div class="input-field col s12">
        {!! Form::textarea('notes', null, ['class' => 'materialize-textarea']) !!}
        {!! Form::label('notes', 'Notas') !!}
    </div>
</div>
