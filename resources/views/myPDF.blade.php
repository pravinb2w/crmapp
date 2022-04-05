<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;

                /** Extra personal styles **/
                background-color: #008B8B;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                /** Extra personal styles **/
            }

            .footer-table td {
                border-collapse: separate !important;
                border: 1px solid;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            Nicesnippets.com
        </header>

        <footer>
            <table style="width: 100%" class="footer-table">
                <tr>
                    <td style="width: 100%">
                        <h5>Terms and Condition</h5>
                        <address style="font-size:11px;">
                                Acceptance and Contract. SELLER’S ACCEPTANCE OF THIS ORDER IS
                            EXPRESSLY CONDITIONED UPON BUYER’S ACCEPTANCE OF ALL
                            TERMS AND CONDITIONS HEREOF. The terms and conditions hereof shall
                            constitute the binding contract between Seller and Buyer concerning the goods
                            sold hereunder. Neither party shall claim any amendment, modification, waiver
                            or release form any provisions hereof unless the same is in writing and signed by
                            both Buyer and Seller.
                        </address>
                    </td>
                    <td style="width:25%;">
                        <div>
                            <h5>E&O.E</h5>
                            <p>Receiver's Signature</p>
                        </div>
                    </td>
                    <td style="width: 25%;">
                        <div>
                            <h5>For Company</h5>
                            <p>Authorized Signatory</p>
                        </div>
                    </td>
               </tr>
           </table>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p style="page-break-after: always;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <p style="page-break-after: never;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </main>
    </body>
</html>