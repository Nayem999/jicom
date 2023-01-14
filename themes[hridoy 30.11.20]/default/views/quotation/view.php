 
    <!doctype html>

    <html>

    <head>

        <meta charset="utf-8"> 

        <meta http-equiv="cache-control" content="max-age=0"/>

        <meta http-equiv="cache-control" content="no-cache"/>

        <meta http-equiv="expires" content="0"/>

        <meta http-equiv="pragma" content="no-cache"/> 

        <style type="text/css" media="all">

            body { color: #000; }
            #receipt-data {margin: 195px 0px 0 0;}

            #wrapper { max-width: 660px; margin: 0 auto; padding-top: 100px; }

            .btn { border-radius: 0; margin-bottom: 5px; }

            .table, .table tr, .table th, .table td{  
                border: 1px solid #000 !important;
             } 

            .table th {
               background: #f5f5f5;  
               font-size: 11px;
               }

            h3 { margin: 5px 0; }

            .signature {
              margin: 30px 0 20px;
               padding-bottom: 70px;
            }
            
            .authorized{
                border: 1px solid #efefef;
                float: left;
                height: 75px;
                padding: 5px 0 0 8px;
                width: 40%;
            }
            .customer{
                border: 1px solid #efefef;
                float: right;
                height: 75px;
                padding: 5px 8px 0 0 ;
                width: 40%;
                margin-left: 3px;
                }
            .authorized > span , .customer > span  {
                border-top: 1px solid #a0a0a1;
            }
            .warranty {
                font-size: 12px;
            }
            #word-of-amount {
                text-transform: uppercase;
                font-size: 11px;
            }
            .hrber {
                border-bottom: 1px solid #000;
                width: 100%; }
            .text{
                margin-top: -125px !important; 
                font-size:11px;
            }
            .inv-logo {
                text-align: center;
            }
            .inv-logo img {
                width: 85%;
                height: 30%;
            }
            @media print {

                .no-print { display: none; }

                #wrapper { max-width: 680px; width: 100%; min-width: 330px; margin: 0 auto; }

            } 

        </style>

    </head>

    <body>
 

<div id="wrapper">

    <div id="receiptData">

    <div class="no-print"> 

    </div>

    <div id="receipt-data">   

        <div class="text">
        <?php echo $quotation->quotation_details; ?>
        </div>
    </div>
 

</body>

</html>
 
