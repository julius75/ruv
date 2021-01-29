@extends('admin.layout.master')
@section('styles')
@endsection
@section('content')
<div class="container">
        <!--begin::Notice-->
        <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
            <div class="alert-icon">
                <span class="svg-icon svg-icon-primary svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3" />
                            <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </div>
            <div class="alert-text">DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table.
                <br />For more info see
                <a class="font-weight-bold" href="https://datatables.net/" target="_blank">the official home</a>of the plugin.</div>
        </div>
        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Basic Demo
                        <span class="d-block text-muted pt-2 font-size-sm">sorting &amp; pagination remote datasource</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="svg-icon svg-icon-md">
													<!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
														</g>
													</svg>
                                                    <!--end::Svg Icon-->
												</span>Export</button>
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-print"></i>
																</span>
                                        <span class="navi-text">Print</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-copy"></i>
																</span>
                                        <span class="navi-text">Copy</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-excel-o"></i>
																</span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-text-o"></i>
																</span>
                                        <span class="navi-text">CSV</span>
                                    </a>
                                </li>
                                <li class="navi-item">
                                    <a href="#" class="navi-link">
																<span class="navi-icon">
																	<i class="la la-file-pdf-o"></i>
																</span>
                                        <span class="navi-text">PDF</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>New Record</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Order ID</th>
                        <th>Country</th>
                        <th>Ship City</th>
                        <th>Ship Address</th>
                        <th>Company Agent</th>
                        <th>Company Name</th>
                        <th>Ship Date</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>64616-103</td>
                        <td>Brazil</td>
                        <td>São Félix do Xingu</td>
                        <td>698 Oriole Pass</td>
                        <td>Hayes Boule</td>
                        <td>Casper-Kerluke</td>
                        <td>10/15/2017</td>
                        <td>5</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>54868-3377</td>
                        <td>Vietnam</td>
                        <td>Bình Minh</td>
                        <td>8998 Delaware Court</td>
                        <td>Humbert Bresnen</td>
                        <td>Hodkiewicz and Sons</td>
                        <td>4/24/2016</td>
                        <td>2</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>0998-0355</td>
                        <td>Philippines</td>
                        <td>Palagao Norte</td>
                        <td>91796 Sutteridge Road</td>
                        <td>Jareb Labro</td>
                        <td>Kuhlman Inc</td>
                        <td>7/11/2017</td>
                        <td>6</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>55154-6876</td>
                        <td>China</td>
                        <td>Jiannan</td>
                        <td>8 Muir Drive</td>
                        <td>Krishnah Tosspell</td>
                        <td>Prosacco-Kessler</td>
                        <td>2/5/2016</td>
                        <td>1</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>49349-069</td>
                        <td>United States</td>
                        <td>Shawnee Mission</td>
                        <td>782 Mallory Lane</td>
                        <td>Dale Kernan</td>
                        <td>Bernier and Sons</td>
                        <td>7/23/2017</td>
                        <td>5</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>53499-0393</td>
                        <td>Ukraine</td>
                        <td>Kozel’shchyna</td>
                        <td>02 Briar Crest Parkway</td>
                        <td>Halley Bentham</td>
                        <td>Schoen-Metz</td>
                        <td>2/21/2016</td>
                        <td>1</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>43074-105</td>
                        <td>Philippines</td>
                        <td>De la Paz</td>
                        <td>643 Mayer Road</td>
                        <td>Burgess Penddreth</td>
                        <td>DuBuque, Stanton and Stanton</td>
                        <td>10/25/2016</td>
                        <td>5</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>76328-333</td>
                        <td>Portugal</td>
                        <td>Sobreira</td>
                        <td>6715 Dakota Parkway</td>
                        <td>Cob Sedwick</td>
                        <td>Homenick-Nolan</td>
                        <td>2/18/2016</td>
                        <td>3</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>21130-054</td>
                        <td>France</td>
                        <td>Roissy Charles-de-Gaulle</td>
                        <td>4942 Darwin Hill</td>
                        <td>Tabby Callaghan</td>
                        <td>Daugherty-Considine</td>
                        <td>3/26/2016</td>
                        <td>2</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>68788-9890</td>
                        <td>Dominican Republic</td>
                        <td>Cristóbal</td>
                        <td>854 Dapin Terrace</td>
                        <td>Broddy Jarry</td>
                        <td>Walter Group</td>
                        <td>8/10/2016</td>
                        <td>1</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>68428-740</td>
                        <td>Morocco</td>
                        <td>Tidili Mesfioua</td>
                        <td>67 Talisman Drive</td>
                        <td>Marjorie McGougan</td>
                        <td>Littel and Sons</td>
                        <td>2/8/2016</td>
                        <td>6</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>43269-779</td>
                        <td>Yemen</td>
                        <td>Az Zāhir</td>
                        <td>5583 Walton Hill</td>
                        <td>Edsel Sprigging</td>
                        <td>Kulas, Huels and Strosin</td>
                        <td>11/13/2017</td>
                        <td>6</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>0573-0174</td>
                        <td>Armenia</td>
                        <td>Doghs</td>
                        <td>7024 Eagan Court</td>
                        <td>Jess Gouldeby</td>
                        <td>Moen Group</td>
                        <td>9/10/2017</td>
                        <td>5</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>67868-117</td>
                        <td>Indonesia</td>
                        <td>Pakemitan</td>
                        <td>141 Spaight Avenue</td>
                        <td>Marys Matzl</td>
                        <td>Emard-Gerhold</td>
                        <td>3/5/2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>0641-6114</td>
                        <td>Kazakhstan</td>
                        <td>Shu</td>
                        <td>601 Chinook Street</td>
                        <td>Gabrila Franscioni</td>
                        <td>Gusikowski LLC</td>
                        <td>6/21/2016</td>
                        <td>4</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>63629-4970</td>
                        <td>Thailand</td>
                        <td>Chang Klang</td>
                        <td>7109 Ilene Place</td>
                        <td>Cozmo Booker</td>
                        <td>Dickinson-Klein</td>
                        <td>2/29/2016</td>
                        <td>1</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>59528-4456</td>
                        <td>Canada</td>
                        <td>Melfort</td>
                        <td>141 Aberg Pass</td>
                        <td>Arlie Larking</td>
                        <td>Rosenbaum Group</td>
                        <td>7/7/2017</td>
                        <td>4</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>0054-0080</td>
                        <td>Iceland</td>
                        <td>Sandgerði</td>
                        <td>4 Derek Alley</td>
                        <td>Yorker Scogings</td>
                        <td>Gorczany LLC</td>
                        <td>7/6/2017</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>28475-810</td>
                        <td>Indonesia</td>
                        <td>Keleng</td>
                        <td>49 Swallow Court</td>
                        <td>Dominick Muscott</td>
                        <td>Swaniawski-Sipes</td>
                        <td>5/15/2016</td>
                        <td>2</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>53645-1070</td>
                        <td>Russia</td>
                        <td>Tugulym</td>
                        <td>611 Hintze Place</td>
                        <td>Laurette Kynforth</td>
                        <td>Torp-Satterfield</td>
                        <td>10/18/2017</td>
                        <td>1</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>66869-137</td>
                        <td>Indonesia</td>
                        <td>Binangun</td>
                        <td>535 Delladonna Trail</td>
                        <td>Beryl Lycett</td>
                        <td>Schoen Inc</td>
                        <td>6/28/2017</td>
                        <td>3</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>0069-0181</td>
                        <td>Czech Republic</td>
                        <td>Tlumačov</td>
                        <td>8 Hauk Street</td>
                        <td>Carny Boggas</td>
                        <td>Kuphal LLC</td>
                        <td>6/24/2016</td>
                        <td>2</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>50580-449</td>
                        <td>United States</td>
                        <td>Saint Augustine</td>
                        <td>9050 High Crossing Pass</td>
                        <td>Dyana Axelby</td>
                        <td>Runolfsdottir-Hayes</td>
                        <td>3/16/2017</td>
                        <td>2</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>55714-2247</td>
                        <td>Netherlands</td>
                        <td>Nijmegen</td>
                        <td>2 Laurel Avenue</td>
                        <td>Orelle Duffy</td>
                        <td>Roberts and Sons</td>
                        <td>4/5/2016</td>
                        <td>5</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>48951-1208</td>
                        <td>Russia</td>
                        <td>Ryazhsk</td>
                        <td>131 Lerdahl Park</td>
                        <td>Taylor Kinder</td>
                        <td>Terry-Howell</td>
                        <td>4/19/2017</td>
                        <td>3</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>26</td>
                        <td>30142-179</td>
                        <td>Russia</td>
                        <td>Kazan</td>
                        <td>7 Erie Pass</td>
                        <td>Emanuele Aylesbury</td>
                        <td>Torp LLC</td>
                        <td>7/6/2017</td>
                        <td>3</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>27</td>
                        <td>49349-025</td>
                        <td>Thailand</td>
                        <td>Bang Racham</td>
                        <td>98943 Schiller Pass</td>
                        <td>Dorie Gibke</td>
                        <td>Tremblay and Sons</td>
                        <td>7/17/2017</td>
                        <td>1</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>28</td>
                        <td>55154-4989</td>
                        <td>Russia</td>
                        <td>Solnechnyy</td>
                        <td>485 Mockingbird Road</td>
                        <td>Melisandra Harragin</td>
                        <td>Turner-Cartwright</td>
                        <td>12/3/2016</td>
                        <td>5</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>29</td>
                        <td>13537-426</td>
                        <td>Lebanon</td>
                        <td>Marjayoûn</td>
                        <td>9141 Cascade Street</td>
                        <td>Berenice Lampett</td>
                        <td>Johnston-Fritsch</td>
                        <td>12/27/2017</td>
                        <td>2</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>30</td>
                        <td>52565-009</td>
                        <td>Jamaica</td>
                        <td>Manchioneal</td>
                        <td>88503 Shopko Center</td>
                        <td>Tammie McMurthy</td>
                        <td>Sipes, Conn and Stiedemann</td>
                        <td>10/11/2017</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>31</td>
                        <td>0264-5535</td>
                        <td>United Kingdom</td>
                        <td>Glasgow</td>
                        <td>6 Lakeland Center</td>
                        <td>Dinnie Joyes</td>
                        <td>Keebler Group</td>
                        <td>6/5/2016</td>
                        <td>5</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>32</td>
                        <td>15370-110</td>
                        <td>China</td>
                        <td>Caijiang</td>
                        <td>2 Mariners Cove Way</td>
                        <td>Kerianne Axelbey</td>
                        <td>Wolff, Sporer and Bechtelar</td>
                        <td>2/20/2016</td>
                        <td>6</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>33</td>
                        <td>67046-271</td>
                        <td>China</td>
                        <td>Sanhe</td>
                        <td>537 Graceland Park</td>
                        <td>Kiley MacTerlagh</td>
                        <td>Hauck Inc</td>
                        <td>6/9/2017</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>34</td>
                        <td>49288-0356</td>
                        <td>Indonesia</td>
                        <td>Rupe</td>
                        <td>88 Blackbird Alley</td>
                        <td>Trula Shuttle</td>
                        <td>Will-Morissette</td>
                        <td>2/28/2016</td>
                        <td>5</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>35</td>
                        <td>41163-332</td>
                        <td>Poland</td>
                        <td>Borowno</td>
                        <td>72 Iowa Drive</td>
                        <td>Hollis Brislen</td>
                        <td>Lowe, Jaskolski and Gulgowski</td>
                        <td>7/7/2016</td>
                        <td>4</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>36</td>
                        <td>68428-088</td>
                        <td>Greece</td>
                        <td>Néa Péramos</td>
                        <td>76 Haas Alley</td>
                        <td>Marsh Battin</td>
                        <td>Fay LLC</td>
                        <td>6/3/2017</td>
                        <td>6</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>37</td>
                        <td>52686-288</td>
                        <td>Chile</td>
                        <td>San Carlos</td>
                        <td>6915 Mifflin Terrace</td>
                        <td>Patrizio Pinnion</td>
                        <td>Haag-Stokes</td>
                        <td>10/7/2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>38</td>
                        <td>68084-534</td>
                        <td>Ukraine</td>
                        <td>Ukrainka</td>
                        <td>77 Charing Cross Trail</td>
                        <td>Ilario Daouse</td>
                        <td>Nitzsche, Davis and Romaguera</td>
                        <td>4/10/2016</td>
                        <td>3</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>39</td>
                        <td>60681-2104</td>
                        <td>China</td>
                        <td>Shangdu</td>
                        <td>61653 Welch Trail</td>
                        <td>Blisse Coleborn</td>
                        <td>Bailey, Windler and Marquardt</td>
                        <td>5/15/2017</td>
                        <td>6</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>40</td>
                        <td>63402-193</td>
                        <td>China</td>
                        <td>Xibin</td>
                        <td>9 Duke Point</td>
                        <td>Augustin Jouannisson</td>
                        <td>Witting, Reilly and Morar</td>
                        <td>7/3/2016</td>
                        <td>3</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>41</td>
                        <td>0078-0614</td>
                        <td>Russia</td>
                        <td>Skolkovo</td>
                        <td>5 Bay Center</td>
                        <td>Kaleena Jennison</td>
                        <td>Johnston Inc</td>
                        <td>11/26/2016</td>
                        <td>5</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>42</td>
                        <td>60660-7787</td>
                        <td>Dominican Republic</td>
                        <td>Pimentel</td>
                        <td>5 Northwestern Drive</td>
                        <td>Mariel Petronis</td>
                        <td>Mitchell, Bashirian and Schroeder</td>
                        <td>1/28/2016</td>
                        <td>5</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>43</td>
                        <td>51079-345</td>
                        <td>Malaysia</td>
                        <td>Kuala Lumpur</td>
                        <td>11 Melvin Hill</td>
                        <td>Adamo Scroggie</td>
                        <td>Cartwright Group</td>
                        <td>6/9/2016</td>
                        <td>4</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>44</td>
                        <td>29033-021</td>
                        <td>Portugal</td>
                        <td>Serzedelo</td>
                        <td>380 Wayridge Street</td>
                        <td>Lewiss Kilmartin</td>
                        <td>Stroman-Orn</td>
                        <td>5/9/2017</td>
                        <td>3</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>45</td>
                        <td>12830-816</td>
                        <td>France</td>
                        <td>Fos-sur-Mer</td>
                        <td>9924 Mariners Cove Circle</td>
                        <td>Claretta Sachno</td>
                        <td>Zemlak-Cruickshank</td>
                        <td>9/4/2016</td>
                        <td>4</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>46</td>
                        <td>0781-5555</td>
                        <td>Indonesia</td>
                        <td>Kotaagung</td>
                        <td>9 Calypso Road</td>
                        <td>Bryn Van Castele</td>
                        <td>Beier-Mante</td>
                        <td>3/17/2017</td>
                        <td>5</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>47</td>
                        <td>0378-7004</td>
                        <td>Sweden</td>
                        <td>Karlstad</td>
                        <td>12000 Burrows Street</td>
                        <td>Tades Gatch</td>
                        <td>Klocko, Koelpin and Nikolaus</td>
                        <td>7/10/2016</td>
                        <td>5</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>48</td>
                        <td>49483-052</td>
                        <td>Indonesia</td>
                        <td>Kebonjaya</td>
                        <td>2 Oakridge Crossing</td>
                        <td>Reinold Jolland</td>
                        <td>Zieme-Funk</td>
                        <td>5/24/2016</td>
                        <td>4</td>
                        <td>2</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>49</td>
                        <td>10812-357</td>
                        <td>Serbia</td>
                        <td>Ruma</td>
                        <td>7 Wayridge Plaza</td>
                        <td>Ky Brainsby</td>
                        <td>Towne Inc</td>
                        <td>11/1/2016</td>
                        <td>2</td>
                        <td>3</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    <tr>
                        <td>50</td>
                        <td>49349-222</td>
                        <td>China</td>
                        <td>Zhulan</td>
                        <td>55385 Stoughton Trail</td>
                        <td>Sheryl Giddings</td>
                        <td>Grimes, Ryan and Larkin</td>
                        <td>9/15/2017</td>
                        <td>3</td>
                        <td>1</td>
                        <td nowrap="nowrap"></td>
                    </tr>
                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Card-->
        <!--end::Card-->
    </div>
@endsection
@section('scripts')
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/pages/crud/datatables/basic/basic.js"></script>@endsection

