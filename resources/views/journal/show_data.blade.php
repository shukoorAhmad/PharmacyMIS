<div class="col-12 box-margin height-card">
    <div class="card">
        <h5 class="mt-2 ml-2">Date {{$date}}</p>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>For</th>
                        <th>Details</th>
                        <th>AFG</th>
                        <th>USD</th>
                        <th>KAL</th>
                        <th>Total (USD)</th>
                    </tr>
                    @foreach ($journals as $journal)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>
                            @switch ($journal->source)
                            @case(1)
                            <a href="">Cash</a>
                            @break

                            @case(2)
                            <a href="">Expense</a>
                            @break

                            @case(3)
                            <a href="">{{ $journal->customer_account_function->customer_function->pharmacy_name }}</a>
                            @break

                            @case(4)
                            <a href="">{{ $journal->seller_account_function->seller_function->seller_name }}</a>
                            @break

                            @case(5)
                            <a href="">{{ $journal->supplier_account_function->supplier_function->name }}</a>
                            @break

                            @default
                            @endswitch
                        </td>
                        <td>
                            @if ($journal->bill_id != 0)
                            <p class="float-left">{{ __('words.For Sale Of Bill No') }}
                                <a href="{{ $journal->bill_id }}">{{ $journal->bill_id }}</a>
                            </p>
                            <p class="float-right">{{ $journal->money }}</p>
                            @else
                            {{ $journal->comment }}
                            @endif
                        </td>
                        <td>
                            <?php echo $journal->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $journal->afg . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $journal->afg . '</p>'; ?>
                        </td>
                        <td>
                            <?php echo $journal->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $journal->usd . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $journal->usd . '</p>'; ?>
                        </td>
                        <td>
                            <?php echo $journal->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $journal->kal . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $journal->kal . '</p>'; ?>
                        </td>
                        <td>
                            <?php $total_usd = 0; ?>
                            @switch ($journal->in_out)
                            @case(1)
                            <p class="float-left">-</p>
                            <p class="float-right">
                                <?php
                                $journal->kal != 0 ? ($total_usd += $journal->kal / $journal->usd_kal) : $total_usd;
                                $journal->afg != 0 ? ($total_usd += $journal->afg / $journal->usd_afg) : $total_usd;
                                echo number_format($total_usd + $journal->usd, 2);
                                ?>
                            </p>
                            @break

                            @case(2)
                            <p class="float-left">
                                <?php
                                $journal->kal != 0 ? ($total_usd += $journal->kal / $journal->usd_kal) : $total_usd;
                                $journal->afg != 0 ? ($total_usd += $journal->afg / $journal->usd_afg) : $total_usd;
                                echo number_format($total_usd + $journal->usd, 2);
                                ?>
                            </p>
                            <p class="float-right">-</p>
                            @break

                            @case(0)
                            <p class="float-left">
                                <?php
                                $journal->kal != 0 ? ($total_usd += $journal->kal / $journal->usd_kal) : $total_usd;
                                $journal->afg != 0 ? ($total_usd += $journal->afg / $journal->usd_afg) : $total_usd;
                                echo number_format($total_usd + $journal->usd, 2);
                                ?>
                            </p>
                            <p class="float-right">-</p>
                            @break

                            @default
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
    </div>
</div>