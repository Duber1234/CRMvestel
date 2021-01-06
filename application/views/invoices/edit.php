<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <form method="post" id="data_form">


            <div class="row">

                <div class="col-sm-4">

                </div>

                <div class="col-sm-3"></div>

                <div class="col-sm-2"></div>

                <div class="col-sm-3">

                </div>

            </div>

            <div class="row">


                <div class="col-sm-6 cmp-pnl">
                    <div id="customerpanel" class="inner-cmp-pnl">
                        <div class="form-group row">
                            <div class="fcol-sm-12">
                                <h3 class="title">
                                    <?php echo $this->lang->line('Bill To') ?> <a href='#'
                                                                                  class="btn btn-primary btn-sm rounded"
                                                                                  data-toggle="modal"
                                                                                  data-target="#addCustomer">
                                        <?php echo $this->lang->line('Add Client') ?>
                                    </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="frmSearch col-sm-12"><label for="cst"
                                                                    class="caption" hidden><?php echo $this->lang->line('Search Client'); ?></label>
                                <input type="text" class="form-control" name="cst" id="customer-box"
                                       placeholder="Enter Customer Name or Mobile Number to search" autocomplete="off"/ hidden>

                                <div id="customer-box-result"></div>
                            </div>

                        </div>
                        <div id="customer">
                            <div class="clientinfo">
                                <?php echo $this->lang->line('Client Details'); ?>
                                <hr>
                                <?php echo '  <input type="hidden" name="customer_id" id="customer_id" value="' . $invoice['csd'] . '">
                                <div id="customer_name"><strong>' . $invoice['name'] . '</strong></div>
                            </div>
                            <div class="clientinfo">

                                <div id="customer_address1"><strong>' . $invoice['documento'] . '<br>' . $invoice['company'] . ',' . $invoice['ciudad'] . '</strong></div>
                            </div>

                            <div class="clientinfo">

                                <div type="text" id="customer_phone">Celular: <strong>' . $invoice['celular'] . '</strong><br>Email: <strong>' . $invoice['email'] . '</strong></div>
                            </div>'; ?>
                                <hr>
                                <div id="customer_pass" hidden></div><?php echo $this->lang->line('') ?> <select
                                        id="warehouses"
                                        class="selectpicker form-control" hidden>
                                    <option value="0"><?php echo $this->lang->line('All') ?></option><?php foreach ($warehouse as $row) {
                                        echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                    } ?>

                                </select>
                            </div>


                        </div>
                    </div>
                    <div class="col-sm-6 cmp-pnl">
                        <div class="inner-cmp-pnl">


                            <div class="form-group row">

                                <div class="col-sm-12"><h3
                                            class="title"><?php echo $this->lang->line('Invoice Properties') ?></h3>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6"><label for="invocieno"
                                                             class="caption"><?php echo $this->lang->line('Invoice Number') ?></label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="icon-file-text-o"
                                                                             aria-hidden="true"></span></div>
                                        <input type="text" class="form-control" placeholder="Invoice #" name="invocieno"
                                               value="<?php echo $invoice['tid']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6"><label for="invocieno"
                                                             class="caption"><?php echo $this->lang->line('') ?>Sede</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="icon-bookmark-o"
                                                                             aria-hidden="true"></span></div>
										<select name="refer" class="form-control">
											<option value="<?php echo $invoice['refer'] ?>">--<?php echo $invoice['refer'] ?>--</option>
											<option value="Yopal">Yopal</option>
											<option value="Monterrey">Monterrey</option>
											<option value="Villanueva">Villanueva</option>
											<option value="Mocoa">Mocoa</option>
										</select>  
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-6"><label for="invociedate"
                                                             class="caption"><?php echo $this->lang->line('Invoice Date'); ?></label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="icon-calendar4"
                                                                             aria-hidden="true"></span></div>
                                        <input type="text" class="form-control required editdate"
                                               placeholder="Billing Date" name="invoicedate" autocomplete="false"
                                               value="<?php echo dateformat($invoice['invoicedate']) ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6"><label for="invocieduedate"
                                                             class="caption"><?php echo $this->lang->line('Invoice Due Date') ?></label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="icon-calendar-o"
                                                                             aria-hidden="true"></span></div>
                                        <input type="text" class="form-control required editdate" name="invocieduedate"
                                               placeholder="Due Date" autocomplete="false"
                                               value="<?php echo dateformat($invoice['invoiceduedate']) ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="taxformat"
                                           class="caption"><?php echo $this->lang->line('Tax') ?></label>
                                    <select class="form-control" name="taxformat" onchange="changeTaxFormat(this.value)"
                                            id="taxformat">
                                        <?php if ($invoice['taxstatus'] == 'yes') {
                                            echo '<option value="on" seleted>&raquo;' . 'Con impuesto' . '</option>';
                                        } else {
                                            echo '<option value="off">&raquo;' . $this->lang->line('Off') . '</option>';
                                        } ?>
                                        <option value="on"><?php echo $this->lang->line('') ?>Con impuesto</option>
                                        <option value="off"><?php echo $this->lang->line('') ?>Sin impuesto</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="discountFormat"
                                               class="caption"><?php echo $this->lang->line('Discount') ?></label>
                                        <select class="form-control" onchange="changeDiscountFormat(this.value)"
                                                id="discountFormat">
                                            <?php echo '<option value="' . $invoice['format_discount'] . '">'.$this->lang->line('').'</option>'; ?>
                                                 <option value="%"><?php echo $this->lang->line('').' '.$this->lang->line('') ?> </option>
                                                <option value="flat"><?php echo $this->lang->line('').' '.$this->lang->line('')  ?>Despues del impuesto</option>
                                                  <option value="b_p"><?php echo $this->lang->line('').' '.$this->lang->line('')  ?>Antes de impuestos</option>
                                                <option value="bflat"><?php echo $this->lang->line('').' '.$this->lang->line('')  ?>Descuento plano antes de impuesto</option>
                                            <!-- <option value="0">Off</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="toAddInfo"
                                           class="caption">Observacion</label>
                                    <textarea class="form-control" name="notes"
                                              rows="2"><?php echo $invoice['notes'] ?></textarea></div>
                            </div>

                        </div>
                    </div>

                </div>


                <div id="saman-row">
                    <table class="table-responsive tfr my_stripe">
                        <thead>

                        <tr class="item_header">
                            <th width="30%" class="text-center"><?php echo $this->lang->line('Item Name') ?></th>
                            <th width="8%" class="text-center"><?php echo $this->lang->line('Quantity') ?></th>
                            <th width="10%" class="text-center"><?php echo $this->lang->line('Rate') ?></th>
                            <th width="10%" class="text-center"><?php echo $this->lang->line('Tax(%)') ?></th>
                            <th width="10%" class="text-center"><?php echo $this->lang->line('Tax') ?></th>
                            <th width="7%" class="text-center"><?php echo $this->lang->line('Discount') ?></th>
                            <th width="10%"
                                class="text-center"><?php echo $this->lang->line('Amount') . ' (' . $this->config->item('currency'); ?>
                                )
                            </th>
                            <th width="5%" class="text-center"><?php echo $this->lang->line('Action') ?></th>
                        </tr></thead> <tbody>
                        <?php $i = 0;
                        foreach ($products as $row) {
                            echo '<tr >
                        <td><input type="text" class="form-control text-center" name="product_name[]"  value="' . $row['product'] . '">
                        </td>
                        <td><input type="text" class="form-control req amnt" name="product_qty[]" id="amount-' . $i . '"
                                   onkeypress="return isNumber(event)" onkeyup="rowTotal(' . $i . '), billUpyog()"
                                   autocomplete="off" value="' . $row['qty'] . '" ><input type="hidden" class="old_amnt" name="old_product_qty[]" value="' . $row['qty'] . '" ></td>
                        <td><input type="text" class="form-control req prc" name="product_price[]" id="price-' . $i . '"
                                   onkeypress="return isNumber(event)" onkeyup="rowTotal(' . $i . '), billUpyog()"
                                   autocomplete="off" value="' . $row['price'] . '"></td>
                        <td> <input type="text" class="form-control vat" name="product_tax[]" id="vat-' . $i . '"
                                    onkeypress="return isNumber(event)" onkeyup="rowTotal(' . $i . '), billUpyog()"
                                    autocomplete="off"  value="' . $row['tax'] . '"></td>
                        <td class="text-center" id="texttaxa-' . $i . '">' . $row['totaltax'] . '</td>
                        <td><input type="text" class="form-control discount" name="product_discount[]"
                                   onkeypress="return isNumber(event)" id="discount-' . $i . '"
                                   onkeyup="rowTotal(' . $i . '), billUpyog()" autocomplete="off"  value="' . $row['discount'] . '"></td>
                        <td><span class="currenty">' . $this->config->item('currency') . '</span>
                            <strong><span class="ttlText" id="result-' . $i . '">' . $row['subtotal'] . '</span></strong></td>
                        <td class="text-center">
<button type="button" data-rowid="' . $i . '" class="btn btn-danger removeProd" title="Remove"> <i class="icon-minus-square"></i> </button>
                        </td>
                        <input type="hidden" name="taxa[]" id="taxa-' . $i . '" value="' . $row['totaltax'] . '">
                        <input type="hidden" name="disca[]" id="disca-' . $i . '" value="' . $row['totaldiscount'] . '">
                        <input type="hidden" class="ttInput" name="product_subtotal[]" id="total-' . $i . '" value="' . $row['subtotal'] . '">
                        <input type="hidden" class="pdIn" name="pid[]" id="pid-' . $i . '" value="' . $row['pid'] . '">
                    </tr> <tr class="desc_p"><td colspan="8"><textarea id="dpid-' . $i . '" class="form-control" name="product_description[]" placeholder="'.$this->lang->line('Enter Product description').'" autocomplete="off">' . $row['product_des'] . '</textarea><br></td></tr>';
                            $i++;
                        } ?>
                        <tr class="last-item-row sub_c">
                            <td class="add-row">
                                <button type="button" class="btn btn-success" aria-label="Left Align"
                                        data-toggle="tooltip"
                                        data-placement="top" title="Add product row" id="addproduct">
                                    <i class="icon-plus-square"></i> <?php echo $this->lang->line('Add Row') ?>
                                </button>
                            </td>
                            <td colspan="7"></td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="6" align="right"><input type="hidden"
                                                                 value="<?php echo $invoice['subtotal'] ?>"
                                                                 id="subttlform"
                                                                 name="subtotal"><strong><?php echo $this->lang->line('Total Tax') ?></strong>
                            </td>
                            <td align="left" colspan="2"><span
                                        class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                                <span id="taxr" class="lightMode"><?php echo $invoice['tax'] ?></span></td>
                        </tr>
                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="6" align="right">
                                <strong><?php echo $this->lang->line('Total Discount') ?></strong></td>
                            <td align="left" colspan="2"><span
                                        class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                                <span id="discs" class="lightMode"><?php echo $invoice['discount'] ?></span></td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
							<td colspan="2"><strong>ASIGNAR SERVICIO</strong>
                            <td colspan="4" align="right"><strong><?php echo $this->lang->line('Shipping') ?></strong>
                            </td>
                            <td align="left" colspan="2"><input type="text" class="form-control shipVal"
                                                                onkeypress="return isNumber(event)" placeholder="Value"
                                                                name="shipping" autocomplete="off"
                                                                onkeyup="updateTotal()"
                                                                value="<?php echo $invoice['shipping'] ?>"></td>
                        </tr>

                        <tr class="sub_c" style="display: table-row;">
                            <td colspan="2" hidden><?php if ($exchange['active'] == 1){
                                echo $this->lang->line('Payment Currency client') . ' <small>' . $this->lang->line('based on live market') ?></small>
                                <select name="mcurrency"
                                        class="selectpicker form-control">

                                    <?php
                                    echo '<option value="' . $invoice['multi'] . '">Do not change</option><option value="0">None</option>';
                                    foreach ($currency as $row) {

                                        echo '<option value="' . $row['id'] . '">' . $row['symbol'] . ' (' . $row['code'] . ')</option>';
                                    } ?>

                                </select><?php } ?></td>
								<td colspan="2">Television</small>
                                    <select name="television" class="selectpicker form-control">
                                        <option value="<?php echo $invoice['television']; ?>">--<?php echo $invoice['television']; ?></option>
										<option value="no">No</option>
                                        <option value="Television">Si</option>
                                </select></td>
                            <td colspan="4" align="right"><strong><?php echo $this->lang->line('Grand Total') ?> (<span
                                            class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>)</strong>
                            </td>
                            <td align="left" colspan="2"><input type="text" name="total" class="form-control"
                                                                id="invoiceyoghtml"
                                                                value="<?php echo $invoice['total']; ?>" readonly="">

                            </td>
                        </tr>
                        <tr class="sub_c" style="display: table-row;" hidden="">
                            <td colspan="2" hidden><?php echo $this->lang->line('Payment Terms') ?> <select name="pterms" class="selectpicker form-control"><?php echo '<option value="' . $invoice['termid'] . '">*' . $invoice['termtit'] . '</option>';
                                    foreach ($terms as $row) {
                                        echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                    } ?>


                                </select></td>
                         <tr class="sub_c" style="display: table-row;">
							 <td colspan="2">Internet
							 <select name="combo" class="selectpicker form-control">
										<option value="<?php echo $invoice['combo']; ?>">--<?php echo $invoice['combo']; ?></option>
								 		<option value="no">No</option>							 		
                                        <option value="1Mega">1 Mega</option>
										<option value="2Megas">2 Megas</option>
                                        <option value="3Megas">3 Megas</option>
										<option value="5Megas">5 Megas</option>
										<option value="10Megas">10 Megas</option>
                                    </select></td>
                            <td align="right" colspan="6"><input type="submit" class="btn btn-success sub-btn" value="<?php echo $this->lang->line('Update') ?>"
                                                                 id="submit-data" data-loading-text="Updating...">
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>

                <input type="hidden" value="invoices/editaction" id="action-url">
                <input type="hidden" value="search" id="billtype">
                <input type="hidden" value="<?php echo $i - 1; ?>" name="counter" id="ganak">
                <input type="hidden" value="<?php echo $this->config->item('currency'); ?>" name="currency">
                <input type="hidden" value="%" name="taxformat" id="tax_format">
                <input type="hidden" value="%" name="discountFormat" id="discount_format">
                <input type="hidden" value="yes" name="tax_handle" id="tax_status">
                <input type="hidden" value="yes" name="applyDiscount" id="discount_handle">


        </form>
    </div>

</article>

<div class="modal fade" id="addCustomer" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Add Customer') ?></h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p><input type="hidden" name="mcustomer_id" id="mcustomer_id" value="0">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="name"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name"
                                           class="form-control margin-bottom" id="mcustomer_name" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone"
                                           class="form-control margin-bottom" name="phone" id="mcustomer_phone">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="email"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-10">
                                    <input type="email" placeholder="Email"
                                           class="form-control margin-bottom crequired" name="email"
                                           id="mcustomer_email">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="address"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address"
                                           class="form-control margin-bottom " name="address" id="mcustomer_address1">
                                </div>
                            </div>
                            <div class="form-group row">


                                <div class="col-sm-6">
                                    <input type="text" placeholder="City"
                                           class="form-control margin-bottom" name="city" id="mcustomer_city">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Region" id="region"
                                           class="form-control margin-bottom" name="region">
                                </div>

                            </div>

                            <div class="form-group row">


                                <div class="col-sm-6">
                                    <input type="text" placeholder="Country"
                                           class="form-control margin-bottom" name="country" id="mcustomer_country">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="PostBox" id="postbox"
                                           class="form-control margin-bottom" name="postbox">
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <input type="text" placeholder="Company"
                                           class="form-control margin-bottom" name="company">
                                </div>

                                <div class="col-sm-6">
                                    <input type="text" placeholder="TAX ID"
                                           class="form-control margin-bottom" name="taxid" >
                                </div>


                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="customergroup"><?php echo $this->lang->line('Group') ?></label>

                                <div class="col-sm-10">
                                    <select name="customergroup" class="form-control">
                                        <?php
                                        foreach ($customergrouplist as $row) {
                                            $cid = $row['id'];
                                            $title = $row['title'];
                                            echo "<option value='$cid'>$title</option>";
                                        }
                                        ?>
                                    </select>


                                </div>
                            </div>


                        </div>

                        <!-- shipping -->
                        <div class="col-sm-6">
                            <h5><?php echo $this->lang->line('Shipping Address') ?></h5>
                            <div class="form-group row">

                                <div class="input-group">
                                    <label class="display-inline-block custom-control custom-radio ml-1">
                                        <input type="checkbox" name="customer1" class="custom-control-input"
                                               id="copy_address">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description ml-0"><?php echo $this->lang->line('Same As Billing') ?></span>
                                    </label>

                                </div>

                                <div class="col-sm-10">
                                    <?php echo $this->lang->line("leave Shipping Address") ?>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="name_s"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name"
                                           class="form-control margin-bottom" id="mcustomer_name_s" name="name_s"
                                           required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="phone_s"><?php echo $this->lang->line('Phone') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone"
                                           class="form-control margin-bottom" name="phone_s" id="mcustomer_phone_s">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="email_s"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-10">
                                    <input type="email" placeholder="Email"
                                           class="form-control margin-bottom" name="email_s"
                                           id="mcustomer_email_s">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="address_s"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address"
                                           class="form-control margin-bottom " name="address_s"
                                           id="mcustomer_address1_s">
                                </div>
                            </div>
                            <div class="form-group row">


                                <div class="col-sm-6">
                                    <input type="text" placeholder="City"
                                           class="form-control margin-bottom" name="city_s" id="mcustomer_city_s">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Region" id="region_s"
                                           class="form-control margin-bottom" name="region_s">
                                </div>

                            </div>

                            <div class="form-group row">


                                <div class="col-sm-6">
                                    <input type="text" placeholder="Country"
                                           class="form-control margin-bottom" name="country_s" id="mcustomer_country_s">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="PostBox" id="postbox_s"
                                           class="form-control margin-bottom" name="postbox_s">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="mclient_add" class="btn btn-primary submitBtn" value="ADD"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript"> $('.editdate').datepicker({autoHide: true, format: '<?php echo $this->config->item('dformat2'); ?>'});</script>