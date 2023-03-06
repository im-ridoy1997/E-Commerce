@extends('frontend.layout')
@section('page_title','Checkout')
@section('content')


<div class="rules-area ptb-100">
    <div class=" mt-5" style="margin-left: 10%; margin-right:10%;">
        <h4>Checkout</h4>
        <form action="" id="cart-full-section">
            <div class="" style="margin-top: 20px;">
                <table class="table table-bordered table-striped" id="cart">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Size <br>Unit</th>
                            <th>Color</th>
                            <th>Material <br>Grade</th>
                            <th>Weight</th>
                            <th>Weight <br>Unit</th>
                            <th>Package/CTN</th>
                            <th>{Price</th>
                            <th>Quantity</th>
                            <th>Quantity / CTN</th>
                            <th>Total / CTN</th>
                            <th>Total <br>Price</th>
                            <th>Requirement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                    @foreach($data as $key => $val)
                        <tr>
                            <td>{{ $val->sku }}</td>
                            <td>
                                <?php 
                                    $file_type = mime_content_type('products/'.$val->image->image);
                                    $file_ext = explode('/', $file_type)[1];
                                ?>
                                @if($file_ext == 'mp4')
                                    <video width="60" height="50"  controls>
                                        <source src="{{URL::asset('products/'.$val->image->image)}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <a target="_blank" href="{{ url('products/'.$val->image->image) }}">
                                    <img style="height: 40px !important;" src="{{ url('products/'.$val->image->image) }}"/>
                                    </a>
                                @endif
                            </td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->size }}</td>
                            <td>{{ $val->unit }}</td>
                            <td>{{ $val->color }}</td>
                            <td>{{ $val->material }}</td>
                            <td>{{ $val->weight }}</td>
                            <td>{{ $val->weight_unit }}</td>
                            <td>
                                {{ $val->inner_pack_qty }} {{ $val->inner_pack_unit }}<br>
                                {{ $val->mid_pack_qty }} {{ $val->mid_pack_unit }}<br>
                                {{ $val->big_pack_qty }} {{ $val->big_pack_unit }}
                            </td>
                            <td>
                                {{ $val->price_term }}<br>
                                {{ $val->currency }}<br>
                                {{ $val->price }}<br>
                                {{ $val->price_per_unit }}
                            </td>
                            <td>{{ $val->moq }}</td>
                            <td>{{ $val->quantity_ctn }}</td>
                            <td>{{ $val->total_ctn }}</td>
                            <td>{{ $val->price * $val->moq }}</td>
                            <td>{{ $val->requirement }}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-warning actbtn" title="Edit" onclick="cartEdit('{{ $val->id }}', '{{ $key }}')"><i class="fas fa-edit"></i></a>
                                <a href="javascript:void(0)" class="btn btn-danger actbtn" onclick="cartDelete('{{ $val->id }}', '{{ $key }}')" title="Delete"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="display: flex; float: right;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="margin-right: 40px;"><h6>{{ GoogleTranslate::trans('Total Ctn:', app()->getLocale()) }} <span> {{$total_ctn}}</span></h6></div>
                        <div><h6>{{ GoogleTranslate::trans('Total Price:', app()->getLocale()) }} <span>{{$total_price}}</span></h6></div>
                    </div>
                </div>
            </div>
            @if(Auth::guard('member')->user())
            <div style="margin-left: 30%; margin-right:30%; margin-top: 50px !important;">
                <label for="message" class="form-label">{{ GoogleTranslate::trans('Message', app()->getLocale()) }}</label>
                <textarea class="form-control" name="message" id="message" rows="5"></textarea>
            </div>
            <div style="text-align: center; margin-top: 10px;">
                <input type="submit" value="Submit" id="cartSubmitForRegisteredUser" class="btn btn-success">
            </div>
            @else
            <div style="margin-left: 10%; margin-right:10%; margin-top: 50px;">
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label for="company_name">{{ GoogleTranslate::trans('Company Name', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="company_name" id="company_name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                            <label for="year">{{ GoogleTranslate::trans('Year of Establishment', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="year" id="year">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label for="address_one">{{ GoogleTranslate::trans('Address Line 1', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="address_one" id="address_one">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                        <label for="address_two">{{ GoogleTranslate::trans('Address Line 2', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="address_two" id="address_two">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div>
                            <label for="city">{{ GoogleTranslate::trans('City', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="city" id="city">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="state">{{ GoogleTranslate::trans('Province / State', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="state" id="state">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="zip">{{ GoogleTranslate::trans('Zip', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="zip" id="zip">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label for="phone">{{ GoogleTranslate::trans('Phone no', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                        <label for="fax">{{ GoogleTranslate::trans('Fax no', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="fax" id="fax">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div>
                            <label for="website">{{ GoogleTranslate::trans('Website', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="website" id="website">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="whatsapp">{{ GoogleTranslate::trans('Whatsapp', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="whatsapp" id="whatsapp">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="skype">{{ GoogleTranslate::trans('Skype', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="skype" id="skype">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div>
                            <select name="country" id="select-box">
                                <option value="" selected>Select country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antartica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegowina">Bosnia and Herzegowina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo">Congo, the Democratic Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Cota D'Ivoire">Cote d'Ivoire</option>
                                <option value="Croatia">Croatia (Hrvatska)</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands (Malvinas)</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji">Fiji</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="France Metropolitan">France, Metropolitan</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern Territories">French Southern Territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard and McDonald Islands">Heard and Mc Donald Islands</option>
                                <option value="Holy See">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran (Islamic Republic of)</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakhstan">Kazakhstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Democratic People's Republic of Korea">Korea, Democratic People's Republic of</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Lao">Lao People's Democratic Republic</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macau">Macau</option>
                                <option value="Macedonia">Macedonia, The Former Yugoslav Republic of</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia">Micronesia, Federated States of</option>
                                <option value="Moldova">Moldova, Republic of</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherlands">Netherlands</option>
                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Romania">Romania</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                <option value="Saint LUCIA">Saint LUCIA</option>
                                <option value="Saint Vincent">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia (Slovak Republic)</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia">South Georgia and the South Sandwich Islands</option>
                                <option value="Span">Spain</option>
                                <option value="SriLanka">Sri Lanka</option>
                                <option value="St. Helena">St. Helena</option>
                                <option value="St. Pierre and Miguelon">St. Pierre and Miquelon</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard">Svalbard and Jan Mayen Islands</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syrian Arab Republic</option>
                                <option value="Taiwan">Taiwan, Province of China</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania, United Republic of</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Viet Nam</option>
                                <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                <option value="Virgin Islands (U.S)">Virgin Islands (U.S.)</option>
                                <option value="Wallis and Futana Islands">Wallis and Futuna Islands</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Serbia">Serbia</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div>
                            <label for="name">{{ GoogleTranslate::trans('Name', app()->getLocale()) }}</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div>
                        <label for="email">{{ GoogleTranslate::trans('Email', app()->getLocale()) }}</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label for="password">{{ GoogleTranslate::trans('Password', app()->getLocale()) }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="business">{{ GoogleTranslate::trans('Would you like to tell us about your company profile, main business', app()->getLocale()) }}</label>
                            <textarea class="form-control" name="business" id="business" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <label for="business">{{ GoogleTranslate::trans('Message', app()->getLocale()) }}</label>
                            <textarea class="form-control" name="business" id="business" rows="8"></textarea>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    <input type="submit" id="submit-with-register" value="Submit with Register" class="btn btn-success">
                    <!-- <input type="submit" id="submit-without-register" value="Submit without Register" class="btn btn-success"> -->
                </div>
            </div>
            @endif
        </form>
        
    </div>
</div>

<!-- Product Authorize Modal Start -->
<div class="modal fade" id="cartEdit" tabindex="-1" aria-labelledby="cartEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cartEditModalLabel">Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
            <label for="total_ctn">Total CTN</label>
            <input class="form-control" type="text" name="total_ctn" id="total_ctn" value="">
        </div>
        <div>
            <label for="requirement" class="form-label">Requirement</label>
            <textarea class="form-control" name="requirement" id="requirement" rows="5"></textarea>
        </div>
        <input type="hidden" name="id" id="id" value="">
        <input type="hidden" name="key" id="key" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" id="cart-modal-btn" class="btn btn-primary" >Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- Product Authorize Modal End -->

@endsection