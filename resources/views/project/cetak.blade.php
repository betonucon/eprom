<html>
    <head>
        <title>RABOP</title>
        <style>
            html{
                margin:3% 5%;
                font-family: 'Open Sans';
                font-style: normal;
                font-weight: normal;
                src: url(http://themes.googleusercontent.com/static/fonts/opensans/v8/cJZKeOuBrn4kERxqtaUH3aCWcynf_cDxXwCLxiixG1c.ttf) format('truetype');
            }
            .head{
                height:70px;
                width:100%;
                border-bottom:double 4px #000;
                text-align:center;
                font-weight:bold;
                font-size:14px;
                text-transform:uppercase
            }
            table{
                border-collapse:collapse;
            }
            .tth{
                padding:4px;
                background:#b1cdef;
                text-transform:uppercase;
                border:solid 1px #a7a7a7;
            }
            .ttd{
                padding:4px;
                border:solid 1px #a7a7a7;
            }
            .ttdhg{
                padding:4px;
                text-transform:uppercase;
            }
            .ttdf{
                padding:4px;
                text-align:left;
                border:solid 1px #fff;
                font-weight:bold;
                font-size:14px;
            }
            .ttdc{
                padding:4px;
                text-align:center;
                border:solid 1px #a7a7a7;
            }
            .ttdl{
                padding:4px;
                text-align:right;
                border:solid 1px #a7a7a7;
            }
            .body{
                width:100%;
                font-size:12px;
                margin-top:2%;
            }
            .head p{
                margin:2px;
            }
        </style>
    </head>
    <body>
        <div class="head">
            <p>Rencana Anggaran Biaya(RAB)</p>
            <p>Proposal pengajuan rencana project</p>
            <p>PT. Krakatau Perbengkelan dan Perawatan</p>
        </div>
        
        <div class="body"> 
            <table width="100%" border="0">
                
                <tr>
                    <td class="ttdf"  colspan="4">A.INFORMASI PROJECT</td>
                </tr>
                <tr>
                    <td class="ttdhg" width="1%"></td>
                    <td class="ttdhg" width="20%">Customer</td>
                    <td class="ttdhg" width="3%">:</td>
                    <td class="ttdhg" > {{$data->customer}} ({{$data->singkatan_customer}})</td>
                </tr>
                <tr>
                    <td class="ttdhg"></td>
                    <td class="ttdhg">Cost</td>
                    <td class="ttdhg">:</td>
                    <td class="ttdhg" > {{$data->header_cost}}</td>
                </tr>
                <tr>
                    <td class="ttdhg"></td>
                    <td class="ttdhg">DESKRIPSI</td>
                    <td class="ttdhg">:</td>
                    <td class="ttdhg" >  {{$data->deskripsi_project}}</td>
                </tr>
                <tr>
                    <td class="ttdhg"></td>
                    <td class="ttdhg">KATEGORI PROJECT</td>
                    <td class="ttdhg">:</td>
                    <td class="ttdhg" > ({{$data->kategori_project}}) {{$data->keterangan_tipe_project}}</td>
                </tr>
                <tr>
                    <td class="ttdhg"></td>
                    <td class="ttdhg">ESTIMASI PENAWARAN</td>
                    <td class="ttdhg">:</td>
                    <td class="ttdhg" > {{uang($data->nilai_project)}}</td>
                </tr>
                
            
        </table>
        </div>
        <div class="body"> 
            <table width="100%" border="1">
                <tr>
                    <td class="ttdf" colspan="6">B. MATERIAL</td>
                </tr>
                <tr>
                    <th rowspan="2" class="tth">NO</th>
                    <th rowspan="2" class="tth">Komponen Pembiayaan</th>
                    <th class="tth" colspan="2">Volume</th>
                    <th rowspan="2" class="tth">Harga Satuan</th>
                    <th rowspan="2" class="tth">Total</th>
                </tr>
                <tr>
                    <th class="tth">JML</th>
                    <th class="tth">SATUAN</th>
                </tr>
                
                <?php
                    $biaya=0;
                ?>
                @foreach(get_material($data->id) as $no=>$o)
                    <?php
                        $biaya+=$o->total;
                    ?>
                    <tr>
                        <td class="ttdc">{{$no+1}}</td>
                        <td class="ttd">{{$o->nama_material}}</td>
                        <td class="ttdc">{{$o->qty}}</td>
                        <td class="ttdc">{{$o->satuan_material}}</td>
                        <td class="ttdl">{{uang($o->biaya)}}</td>
                        <td class="ttdl">{{uang($o->total)}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="ttdl" colspan="5">TOTAL</td>
                    <td class="ttdl">{{uang(sum_biaya_material($data->id))}}</td>
                </tr>
            </table><br>
            <table width="100%" border="1">
                <tr>
                    <td class="ttdf" colspan="5">C. PEMBIAYAAN LAINNYA</td>
                </tr>
                
                <tr>
                    <th  class="tth" width="5%">NO</th>
                    <th  class="tth">Keterangan</th>
                    <th  class="tth" width="15%">Harga</th>
                    <th  class="tth" width="8%">F(x)</th>
                    <th  class="tth" width="15%">Total</th>
                </tr>
                @foreach(get_operasional($data->id) as $no=>$o)
                    <?php
                        $biaya+=$o->biaya;
                    ?>
                    <tr>
                        <td class="ttdc">{{$no+1}}</td>
                        <td class="ttd">{{$o->nama_material}}</td>
                        <td class="ttdl">{{uang($o->biaya)}}</td>
                        <td class="ttdl">{{uang($o->qty)}}</td>
                        <td class="ttdl">{{uang($o->total)}}</td>
                    </tr>
                @endforeach
                <tr >
                    <td class="ttdl" colspan="4">TOTAL</td>
                    <td class="ttdl">{{uang(sum_biaya_operasional($data->id))}}</td>
                </tr>
            </table><br>
            <table width="100%" border="1">
                <tr>
                    <td class="ttdf" colspan="5">D. JASA</td>
                </tr>
                <tr>
                    <th  class="tth" width="5%">NO</th>
                    <th  class="tth">Keterangan</th>
                    <th  class="tth" width="15%">Harga</th>
                    <th  class="tth" width="8%">F(x)</th>
                    <th  class="tth" width="15%">Total</th>
                </tr>
                @foreach(get_jasa($data->id) as $no=>$o)
                    <?php
                        $biaya+=$o->biaya;
                    ?>
                    <tr>
                        <td class="ttdc">{{$no+1}}</td>
                        <td class="ttd">{{$o->nama_material}}</td>
                        <td class="ttdl">{{uang($o->biaya)}}</td>
                        <td class="ttdl">{{uang($o->qty)}}</td>
                        <td class="ttdl">{{uang($o->total)}}</td>
                    </tr>
                @endforeach
                <tr >
                    <td class="ttdl" colspan="4">TOTAL</td>
                    <td class="ttdl">{{uang(sum_biaya_jasa($data->id))}}</td>
                </tr>
            </table>
            
        </div>
        <div class="body" >
            <table width="100%" border="1">
                <tr>
                    <td class="ttdf" colspan="3">F. RISIKO PROJECT</td>
                </tr>
                <tr>
                    <th class="tth" width="5%">NO</th>
                    <th class="tth">Risiko</th>
                    <th class="tth"  width="20%">Tingkat</th>
                </tr>
                @foreach(get_risiko_project($data->id) as $no=>$o)
                    
                    <tr>
                        <td class="ttdc">{{$no+1}}</td>
                        <td class="ttd">{{$o->risiko}}</td>
                        <td class="ttd">{{$o->status_risiko}}</td>
                    </tr>
                @endforeach
            </table>
            <br>
            <table width="100%" >
               
                    <tr>
                        <td width="40%">
                                
                        </td>
                        <td>

                        </td>
                        <td width="50%">
                            <?php
                                $rencanaall=(sum_biaya_jasa($data->id)+sum_biaya_operasional($data->id)+sum_biaya_operasional($data->id));
                                $permaterial=round((sum_biaya_material($data->id)/$data->nilai_project)*100);
                                $peroperasional=round((sum_biaya_operasional($data->id)/$data->nilai_project)*100);
                                $perjasa=round((sum_biaya_jasa($data->id)/$data->nilai_project)*100);
                                $allcost=$permaterial+$permaterial+$perjasa;
                                $revenue=100-($permaterial+$permaterial+$perjasa);
                            ?>
                            <table width="100%" border="1" align="right">
               
                                <tr>
                                    <td class="ttd" style="background:aqua" colspan="3">TOTAL BIAYA</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Estimasi Penawaran</td>
                                    <td class="ttdl" width="10%" >100%</td>
                                    <td class="ttdl" width="30%" >{{uang($data->nilai_project)}}</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Biaya Material</td>
                                    <td class="ttdl" >{{uang($permaterial)}}%</td>
                                    <td class="ttdl" >{{uang(sum_biaya_material($data->id))}}</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Biaya Operasional</td>
                                    <td class="ttdl" >{{uang($peroperasional)}}%</td>
                                    <td class="ttdl">{{uang(sum_biaya_operasional($data->id))}}</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Biaya Jasa</td>
                                    <td class="ttdl" >{{uang($perjasa)}}%</td>
                                    <td class="ttdl">{{uang(sum_biaya_jasa($data->id))}}</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Persentase RABOB</td>
                                    <td class="ttdl" >{{uang($allcost)}}%</td>
                                    <td class="ttdl">{{uang(sum_biaya_jasa($data->id)+sum_biaya_operasional($data->id)+sum_biaya_operasional($data->id))}}</td>
                                </tr>
                                <tr>
                                    <td class="ttdl">Revenue</td>
                                    <td class="ttdl" >{{uang($revenue)}}%</td>
                                    <td class="ttdl">{{uang(round(($data->nilai_project*(100-$allcost))/100))}}</td>
                                </tr>
                            
                            </table>
                        </td>
                    </tr>
            </table>
        </div>
    </body>
</html>