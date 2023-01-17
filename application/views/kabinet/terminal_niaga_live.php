<!-- END: Subheader -->
<div class="m-subheader " id="loadakuntrading">

    <h3 class="m--margin-bottom-20">MetaTrader Web Terminal</h3>

    <!-- Widget -->
    <div id="webterminal" style="width:100%;height:600px;"></div>
    <script type="text/javascript" src="https://trade.mql5.com/trade/widget.js"></script>
    <script type="text/javascript">
        new MetaTraderWebTerminal("webterminal", {
            version: 4,
            servers: ["TeknologiBerjangka-Demo", "TeknologiBerjangka-Real"],
            server: "TeknologiBerjangka-Demo",
            demoAllServers: true,
            utmSource: "www.tfx.co.id",
            startMode: "create_demo",
            language: "en",
            colorScheme: "black_on_white"
        });
    </script>


</div>



<!-- end:: Body -->