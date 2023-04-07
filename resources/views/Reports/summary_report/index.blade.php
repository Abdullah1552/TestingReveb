@extends('layouts.app')
@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-2">

        </div>
    <div class=" col-md-10">
        <table width="100%" style="font-family: sans-serif;">
            <tbody>
            <tr>
                <td width="33.33%"><img src="../comp_logo/7sky-travel.png" width="150" /></td>
                <td width="33.33%" style="text-align: center;"><h4 style="margin-bottom: 10px;margin-top: 5px;font-size: 14px;">7 Sky Soft <span style="font-size:12px">(Head Office)</span></h4>
                    <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">16 Ferozpur Road, Mozang Chungi, Lahore</p>
                    <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;"> Phone: 4298765432</p>
                    <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Email: azeem@shahtajtravel.com</p>
                    <p style="margin-bottom: 2px;font-size: 12px;margin-top: 2px;">Govt. Lic No:321, IATA No: 133, NTN: 85212</p></td>
                <td width="33.33%" style="text-align: right;"></td>
            </tr>
            <tr style="text-align: center;"><td></td><td></td><td></td></tr>
            </tbody>
        </table>
        <table class="new-table" style="width: 100%; font-family: sans-serif;text-align: center;border: 0px solid #ccc; border-collapse: collapse;">
            <thead>
            <tr>
                <td colspan="12" style="padding-bottom: 5px;">
                    <div class="headerDiv"></div>
                    <div class="headerDiv">
                        <h4 style="margin-bottom: 0px;margin-top: 5px;font-size: 14px;">Simple Sale Register</h4>
                        <h5 style="margin-bottom: 10px; margin-top: 2px; font-size: 12px;">From: 01-07-2020 | To: 05-08-2022</h5>
                    </div>
                    <div class="headerDiv">
                        <h5 style="margin-bottom: 0px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;">Printing Date: 2022-07-05 20:55:22</h5>
                        <!--<h5 style="margin-bottom: 10px; margin-top: 2px; font-size: 11px;text-align: right;font-weight:100;" id="pnumber"></h5>-->
                    </div>
                </td>
            </tr>
            <tr style="border: 1px solid #ccc;">
                <th style="border: 1px solid #ccc; padding:3px;">#</th>
                <th style="border: 1px solid #ccc; padding:3px;">Invoice Date</th>
                <th style="border: 1px solid #ccc; padding:3px;">Invoice Id</th>
                <th style="border: 1px solid #ccc; padding:3px;">Ticket No</th>
                <th style="border: 1px solid #ccc; padding:3px;">Ticket Type</th>
                <th style="border: 1px solid #ccc; padding:3px;">Passenger Name</th>
                <th style="border: 1px solid #ccc; padding:3px;">Sector</th>
                <th style="border: 1px solid #ccc; padding:3px;">Client Code</th>
                <th style="border: 1px solid #ccc; padding:3px;">Payable</th>
                <th style="border: 1px solid #ccc; padding:3px;">Receivable</th>
                <th style="border: 1px solid #ccc; padding:3px;">Payable</th>
                <th style="border: 1px solid #ccc; padding:3px;">Profit/Loss</th>
            </tr>
            </thead>
            <tbody>

            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 1</td>
                <td style="">27-07-2020</td>
                <td style="">173</td>
                <td style="">
                    176-1265-489328</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ALI</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Bukhari Travel </td>
                <td style="">79,500</td>
                <td style="">75,500</td>
                <td style="">4000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 2</td>
                <td style="">27-07-2020</td>
                <td style="">173</td>
                <td style="">
                    176-1265-489329</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ALIA</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Bukhari Travel </td>
                <td style="">79,500</td>
                <td style="">75,500</td>
                <td style="">4000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 3</td>
                <td style="">27-07-2020</td>
                <td style="">173</td>
                <td style="">
                    176-1265-489330</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AHMED</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Bukhari Travel </td>
                <td style="">69,115</td>
                <td style="">65,500</td>
                <td style="">3615.38</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 4</td>
                <td style="">27-07-2020</td>
                <td style="">173</td>
                <td style="">
                    176-1265-489331</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AMNA</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Bukhari Travel </td>
                <td style="">69,115</td>
                <td style="">65,500</td>
                <td style="">3615.38</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 5</td>
                <td style="">27-07-2020</td>
                <td style="">174</td>
                <td style="">
                    084-2308-680402</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">HUZAIFA ALI</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Bukhari Travel </td>
                <td style="">9,376</td>
                <td style="">8,446</td>
                <td style="">930</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 6</td>
                <td style="">19-08-2020</td>
                <td style="">175</td>
                <td style="">
                    214-4355-765898</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">OMAIR SARWER</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Awais khokher</td>
                <td style="">Bukhari Travel </td>
                <td style="">24,000</td>
                <td style="">23,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 7</td>
                <td style="">19-08-2020</td>
                <td style="">175</td>
                <td style="">
                    214-4355-765899</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">KASHIF GHULAM NABI</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Awais khokher</td>
                <td style="">Bukhari Travel </td>
                <td style="">24,000</td>
                <td style="">23,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 8</td>
                <td style="">24-08-2020</td>
                <td style="">176</td>
                <td style="">
                    214-5896-547896</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">HUZAIFA MR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Awais khokher</td>
                <td style="">BSP</td>
                <td style="">40,560</td>
                <td style="">38,760</td>
                <td style="">1800</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 9</td>
                <td style="">26-08-2020</td>
                <td style="">177</td>
                <td style="">
                    214-4344-454555</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AQEEL</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">BSP</td>
                <td style="">23,000</td>
                <td style="">22,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 10</td>
                <td style="">26-08-2020</td>
                <td style="">177</td>
                <td style="">
                    214-4344-454556</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">KHUBAIB</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">BSP</td>
                <td style="">23,000</td>
                <td style="">22,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 11</td>
                <td style="">26-08-2020</td>
                <td style="">177</td>
                <td style="">
                    214-4344-454557</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ASGHAR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">BSP</td>
                <td style="">23,000</td>
                <td style="">22,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 12</td>
                <td style="">26-08-2020</td>
                <td style="">179</td>
                <td style="">
                    214-5456-656566</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AMIR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">BSP</td>
                <td style="">23,000</td>
                <td style="">22,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 13</td>
                <td style="">26-08-2020</td>
                <td style="">179</td>
                <td style="">
                    214-5456-656567</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">WAQAS</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">BSP</td>
                <td style="">23,000</td>
                <td style="">22,000</td>
                <td style="">1000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 14</td>
                <td style="">15-09-2020</td>
                <td style="">184</td>
                <td style="">
                    214-5565-898258</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ALI HAMZA</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">B2B</td>
                <td style="">Saudi Airline</td>
                <td style="">570</td>
                <td style="">550</td>
                <td style="">20</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 15</td>
                <td style="">15-09-2020</td>
                <td style="">184</td>
                <td style="">
                    214-5565-898259</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">MUHAMMAD CAN</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">B2B</td>
                <td style="">Saudi Airline</td>
                <td style="">570</td>
                <td style="">550</td>
                <td style="">20</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 16</td>
                <td style="">28-09-2020</td>
                <td style="">187</td>
                <td style="">
                    214-5658-987899</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AKBAR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">BSP</td>
                <td style="">29,000</td>
                <td style="">25,000</td>
                <td style="">4000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 17</td>
                <td style="">26-09-2020</td>
                <td style="">188</td>
                <td style="">
                    214-5658-989966</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">UMAIR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Al-Rawia</td>
                <td style="">51,000</td>
                <td style="">49,000</td>
                <td style="">2000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 18</td>
                <td style="">28-10-2020</td>
                <td style="">189</td>
                <td style="">
                    214-5698-798898</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">UMAIR SARWER</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Al-Rawia</td>
                <td style="">45,000</td>
                <td style="">42,500</td>
                <td style="">2500</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 19</td>
                <td style="">28-10-2020</td>
                <td style="">189</td>
                <td style="">
                    214-5698-798899</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ASAD ULLAH</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Al-Rawia</td>
                <td style="">45,000</td>
                <td style="">42,500</td>
                <td style="">2500</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 20</td>
                <td style="">28-10-2020</td>
                <td style="">189</td>
                <td style="">
                    214-5698-798900</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">MAJID KHAN</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Al-Rawia</td>
                <td style="">45,500</td>
                <td style="">42,500</td>
                <td style="">3000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 21</td>
                <td style="">28-10-2020</td>
                <td style="">189</td>
                <td style="">
                    214-5698-798901</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">UMER AKMAL</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Al-Rawia</td>
                <td style="">45,000</td>
                <td style="">42,500</td>
                <td style="">2500</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 22</td>
                <td style="">27-09-2020</td>
                <td style="">190</td>
                <td style="">
                    214-5565-549797</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">AKMAL MAJID</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Bukhari Travel </td>
                <td style="">0</td>
                <td style="">0</td>
                <td style="">0</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 23</td>
                <td style="">07-10-2020</td>
                <td style="">191</td>
                <td style="">
                    214-2414-152454</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">SAEED</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Polani Travels</td>
                <td style="">32,500</td>
                <td style="">31,000</td>
                <td style="">1500</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 24</td>
                <td style="">27-10-2020</td>
                <td style="">192</td>
                <td style="">
                    214-5656-989797</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">UMAIR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">BSP</td>
                <td style="">37,000</td>
                <td style="">35,000</td>
                <td style="">2000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 25</td>
                <td style="">27-10-2020</td>
                <td style="">192</td>
                <td style="">
                    214-5656-989798</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">KASHIF</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">BSP</td>
                <td style="">37,000</td>
                <td style="">35,000</td>
                <td style="">2000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 26</td>
                <td style="">12-12-2020</td>
                <td style="">193</td>
                <td style="">
                    321-2365-223332</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ABDULLAH</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Tayyab S</td>
                <td style="">BSP</td>
                <td style="">61,000</td>
                <td style="">58,200</td>
                <td style="">2800</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 27</td>
                <td style="">12-12-2020</td>
                <td style="">193</td>
                <td style="">
                    321-2365-223333</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ABDULLAH MAHAR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Tayyab S</td>
                <td style="">BSP</td>
                <td style="">61,500</td>
                <td style="">53,200</td>
                <td style="">8300</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 28</td>
                <td style="">15-02-2021</td>
                <td style="">194</td>
                <td style="">
                    192-5555-557777</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">WAHEED KARDAAR</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Saudi Airline</td>
                <td style="">167,000</td>
                <td style="">160,000</td>
                <td style="">7000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 29</td>
                <td style="">15-02-2021</td>
                <td style="">194</td>
                <td style="">
                    192-5555-557778</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">TES PERSON</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Saudi Airline</td>
                <td style="">167,000</td>
                <td style="">160,000</td>
                <td style="">7000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 30</td>
                <td style="">15-02-2021</td>
                <td style="">194</td>
                <td style="">
                    192-5555-557779</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">TREE PESON</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Aqeel Dubai</td>
                <td style="">Saudi Airline</td>
                <td style="">167,000</td>
                <td style="">160,000</td>
                <td style="">7000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 31</td>
                <td style="">31-03-2021</td>
                <td style="">195</td>
                <td style="">
                    214-6564-649879</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ASAD</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">asad textile</td>
                <td style="">Al-Rawia</td>
                <td style="">200,000</td>
                <td style="">200,000</td>
                <td style="">0</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 32</td>
                <td style="">09-04-2021</td>
                <td style="">196</td>
                <td style="">
                    214-4546-789846</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ASAD ALI</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">asad textile</td>
                <td style="">Saudi Airline</td>
                <td style="">15,000</td>
                <td style="">15,000</td>
                <td style="">0</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 33</td>
                <td style="">30-04-2021</td>
                <td style="">197</td>
                <td style="">
                    214-5554-658798</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ASAD ALI</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">asad textile</td>
                <td style="">Saudi Airline</td>
                <td style="">69,000</td>
                <td style="">69,000</td>
                <td style="">0</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 34</td>
                <td style="">07-04-2021</td>
                <td style="">198</td>
                <td style="">
                    123-3345-666778</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">VJ</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">VJ</td>
                <td style="">Air-india</td>
                <td style="">97,700</td>
                <td style="">93,700</td>
                <td style="">4000</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 35</td>
                <td style="">05-05-2021</td>
                <td style="">199</td>
                <td style="">
                    122-45454512121</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">UMAIR MUSHTAQ</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Awais khokher</td>
                <td style="">Saudi Airline</td>
                <td style="">1,080</td>
                <td style="">900</td>
                <td style="">180</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 36</td>
                <td style="">05-05-2021</td>
                <td style="">199</td>
                <td style="">
                    122-45454512122</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">ZAHIO</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Awais khokher</td>
                <td style="">Saudi Airline</td>
                <td style="">1,080</td>
                <td style="">900</td>
                <td style="">180</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 37</td>
                <td style="">25-09-2021</td>
                <td style="">200</td>
                <td style="">
                    092-5555-551111</td>
                <td style="">DOMESTIC</td>
                <td style="text-align:left;padding-left:15px;">MRS MRS AMMARA</td>
                <td style="">KHI-ISB</td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Cash Purchase</td>
                <td style="">10,600</td>
                <td style="">8,694</td>
                <td style="">1906.5</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 38</td>
                <td style="">20-12-2021</td>
                <td style="">201</td>
                <td style="">
                    235-1055-789631</td>
                <td style="">INT</td>
                <td style="text-align:left;padding-left:15px;">HASIBULLAH SHAMAL</td>
                <td style=""></td>
                <td style="text-align:left;padding-left:15px;">Muhammad tayyab</td>
                <td style="">Saudi Airline</td>
                <td style="">228</td>
                <td style="">193</td>
                <td style="">35</td>
            </tr>
            <tr style="border-top:1px solid #ccc">
                <td style=""><i class="fa fa-tag" aria-hidden="true"></i> 39</td>
                <td style="">20-12-2021</td>
                <td style="">203</td>
                <td style="">
                    214-4214-515565</td>
                <td style="">DOMESTIC</td>
                <td style="text-align:left;padding-left:15px;">KHADIM HUSSAIN</td>
                <td style="">KDU-ISB,ISB-KDU</td>
                <td style="text-align:left;padding-left:15px;">counter sale</td>
                <td style="">Polani Travels</td>
                <td style="">10,620</td>
                <td style="">11,270</td>
                <td style="">(650)</td>
            </tr>    </tbody>
            <tbody>
            <tr style="border-top:1px solid #000;">
                <th style="border-top: 1px 0px 1px 0px;border-color: #000;">39</th>
                <td colspan="8" style="border-top: 1px 0px 1px 0px;border-color: #000;"></td>
                <th style="border-top:1px solid #000;">1,907,115</th>
                <th style="border-top: 1px solid #000;">1,822,363</th>
                <th style="border-top: 1px solid #000;">84,752</th>
            </tr>
            </tbody>
            <tfoot style="border: 0px;">
            <tr>
                <td colspan="12"><div class="page-footer-space"></div></td>
            </tr>
            </tfoot>
        </table>
        <div id="btns">
            <form method="post">
                <input type="hidden" name="dt_frm" value="01-07-2020">
                <input type="hidden" name="dt_to" value="05-08-2022">
                <input type="hidden" name="branch_id" value="0">
                <button class="btn btn-sm btn-info" formaction="excel/ex_simple_sale_register" type="submit"><i class="fa fa-file-excel-o"></i> Excel</button>
                <button class="btn btn-sm btn-primary" type="submit" formaction="ms-word/w_simple_sale_register"><i class="fa fa-file-word-o"></i> Word</button>
                <button class="btn btn-sm btn-outline-primary" type="button" onClick="show_modal('sinv')"><i class="fa fa-envelope"></i> Email</button>
                <button class="btn btn-sm btn-outline-danger" type="button" onClick="window.print()"><i class="fa fa-file-pdf-o"></i> Print</button>
            </form>
        </div>
        <div class="page-footer">
            <table class="footer" style="width: 100%; font-family: sans-serif;border-top: 1px solid #000;">
                <tr>
                    <td style="padding-top: 10px;padding-bottom: 10px;text-align: left;font-size: 12px;">Powered By: 7skysoft</td>
                    <td style="padding-top: 10px;padding-bottom: 10px;text-align: center;font-size: 12px;">Website: www.7skysoft.com</td>
                    <td style="padding-top: 10px;padding-bottom: 10px;text-align: right;font-size: 12px;">Contact No: 042 37500125 - 03008117582</td>
                </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
    <!--===============================modal------------================-->
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    <input type="hidden" name="dt_frm" value="01-07-2020">
                    <input type="hidden" name="dt_to" value="05-08-2022">
                    <input type="hidden" name="branch_id" value="0">
                    <!-- Modal Header -->
                    <div class="modal-header" style="padding:0px 0px 0px 10px;">
                        <h4 class="modal-title">Send Email</h4>
                        <button type="button" class="close" data-dismiss="modal" style="margin-top:-40px;">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="sender_email" placeholder="Type Sender Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="other_det" placeholder="Other Details...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onClick="send_email()">Send</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function show_modal(thisVal){
            $("#myModal").modal({ backdrop: 'static' });
            $("#form input[name~='type']").val(thisVal);
        }
        function send_email(){
            $(".btn-success").attr("disabled","disabled").html('<i class="fa fa-refresh fa-spin"></i>');
            $.ajax({
                url:"email_script/email_simple_sale_register",
                type:"POST",
                data:$("#form").serialize(),
                success: function(data){
                    if(data==2){
                        alert('Email Sent Successfully...');
                        document.getElementById("form").reset();
                        $("#myModal").modal('hide');
                    }
                    else{
                        alert("Something Wrong...");
                    }
                    $(".btn-success").removeAttr("disabled","disabled").text('Send');
                }
            });
        }
    </script>
@endsection
