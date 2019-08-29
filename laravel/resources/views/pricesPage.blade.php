<h1>Prices here</h1>
<table>
    <thead>
        <tr>
            <th>Currency</th>
            <th>Rate</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($prices as $currency=>$price_info){?>
        <tr class="price-row">
            <td><?php echo $currency?></td>
            <td data-symbol-price="<?php echo $currency; ?>"><?php echo $price_info['price']; ?></td>
            <td data-symbol-status="<?php echo $currency; ?>"><?php echo $price_info['status']; ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>

<script type="text/javascript">
        var es = new EventSource("<?php echo action('HomeController@pricesValues'); ?>");
        es.addEventListener("message", function(e) {
            arr = JSON.parse(e.data);
            
            for (x in arr) {        
                $('[data-symbol-price="' + x + '"]').html(arr[x].price);
                $('[data-symbol-status="' + x + '"]').html(arr[x].status);
                //apply some effect on change, like blinking the color of modified cell...
            }
        }, false);
</script>    