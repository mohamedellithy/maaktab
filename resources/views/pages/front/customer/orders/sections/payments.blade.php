<div class="container-orders">
    <div class="form-group">
        <h5>
            <i class="lni lni-layers"></i>
            مدفوعات المشروع
        </h5>
        <hr class="line-isolate"/>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach($data['payments'] as $payment)
            @php $color = ($payment->status == 'accepted' ? "#00968817" : "white") @endphp
            <table class="table" style="background-color:{{ $color }};">
                <tr>
                    <th>قيمة المدفوع</th>
                    <td>{{ $payment->total_payment }} SAR</td>
                    <th>تاريخ الدفع</th>
                    <td>{{ $payment->created_at }}</td>
                </tr>
                <tr>
                    <th>المشروع</th>
                    <td colspan="5">
                        @if($order->modelable)
                            @if($order->modelable_type == "App\Models\Project")
                                مشروع مماثل ل ({{ $order->modelable->name }})
                            @else
                                طلب خدمة  ( {{ $order->modelable->name }} )
                            @endif
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>حالة المدفوعات</th>
                    <td>{!! get_status_html($payment->status_payment) !!}</td>
                    <th>بوابة الدفع</th>
                    <td>{{ $payment->getaway }}</td>
                </tr>
            </table>
        @endforeach
        {!! $data['payments']->links() !!}
    </div>
</div>