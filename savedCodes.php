<div class="col-5">

    <!-- rang -->
    <div>
        <h5 class="h5Responsive">رنگ :</h5>
    </div>
    <!-- andaze -->
    <div class="mt-3">
        <h5 class="h5Responsive">اندازه :</h5>
    </div>
    <!-- qheymat -->
    <div class="mt-3">
        <h5 class="h5Responsive">قیمت(ریال) :</h5>
    </div>
</div>

<div class="col-7">
    <!-- rang -->
    <!--                        <span class="color" color="--><? //= $orders['product_color']; 
                                                                ?>
    <!--" style="background-color: --><? //= $orders['product_color']; 
                                        ?>
    <!--"></span>-->


    <div class="color" style="
                                                        background-color: <?= $orders['product_color'] ?>;
                                                        border-color: <?= $orders['product_color'] ?>;
                                                        "></div>

    <!-- andaze -->
    <div class="mt-3">
        <h5><small><?= $orders['product_size'] ?></small></h5>
    </div>
    <!-- qheymat -->
    <div class="mt-3">
        <h6 class="h6Responsive" id="product_price_tag_<?= $orders['id'] ?>"><?= modifier_farsidigit(number_format($orders['product_price'])); ?></h6>
    </div>
</div>