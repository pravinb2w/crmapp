
<html>
    <body>
        <!-- Request -->
        <form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp"> 
            <?php
                echo '<input type=hidden name=encRequest value="'.$data.'"">';
                echo '<input type=hidden name=Merchant_Id value="'.$merchant.'">';
            ?>
        </form>
        <script language='javascript'>document.redirect.submit();</script>
    </body>
</html>