<script>
  import { onMount } from "svelte";
  import { loadScript } from "./../document.js";
  import { getContext } from "svelte";
  import { data } from "./../store.js";

  let _data;
  _data = JSON.parse(localStorage.getItem("_data"));

  onMount(async () => {
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/jquery-3.5.1.min.js`,
      `jquery-3.5.1.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/icons/feather-icon/feather.min.js`,
      `feather.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/icons/feather-icon/feather-icon.js`,
      `feather-icon.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/sidebar-menu.js`,
      `sidebar-menu.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/config.js`,
      `config.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/bootstrap/popper.min.js`,
      `popper.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/bootstrap/bootstrap.min.js`,
      `bootstrap.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/chartjs/chart.min.js`,
      `chart.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/chartist/chartist.js`,
      `chartist.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/chartist/chartist-plugin-tooltip.js`,
      `chartist-plugin-tooltip.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/knob/knob.min.js`,
      `knob.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/apex-chart/apex-chart.js`,
      `apex-chart.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/chart/apex-chart/stock-prices.js`,
      `stock-prices.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/prism/prism.min.js`,
      `prism.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/clipboard/clipboard.min.js`,
      `clipboard.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/counter/jquery.waypoints.min.js`,
      `jquery.waypoints.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/counter/jquery.counterup.min.js`,
      `jquery.counterup.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/counter/counter-custom.js`,
      `counter-custom.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/custom-card/custom-card.js`,
      `custom-card.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/owlcarousel/owl.carousel.js`,
      `owl.carousel.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/owlcarousel/owl-custom.js`,
      `owl-custom.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/script.js`,
      `script.js`
    );
    await loadScript(
      `${_data.mypluginurl}/luq/assets/js/theme-customizer/customizera.js`,
      `customizera.js`
    );

    /////////////////////////////////
    //Datatable start
    // await loadScript(`/share/js/jquery-3.5.1.js`, `jquery-3.5.1.js`);
    await loadScript(
      `${_data.mypluginurl}/share/js/jquery.dataTables.min.js`,
      `jquery.dataTables.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/dataTables.buttons.min.js`,
      `dataTables.buttons.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/jszip.min.js`,
      `jszip.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/pdfmake.min.js`,
      `pdfmake.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/vfs_fonts.js`,
      `vfs_fonts.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/buttons.html5.min.js`,
      `buttons.html5.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/buttons.print.min.js`,
      `buttons.print.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/dataTables.select.min.js`,
      `dataTables.select.min.js`
    );
    await loadScript(
      `${_data.mypluginurl}/share/js/dataTables.fixedColumns.min.js`,
      `dataTables.fixedColumns.min.js`
    );

    await loadScript(
      `${_data.mypluginurl}/share/js/buttons.colVis.min.js`,
      `buttons.colVis.min.js`
    );

    await loadScript(
      `${_data.mypluginurl}/share/js/dataTables.cellEdit.js`,
      `dataTables.cellEdit.js`
    );

    //Datatable end
    /////////////////////////////////

    data.update((currentPolls) => {
      _data = currentPolls;
      _data.loadscript = true;
      localStorage.setItem("_data", JSON.stringify(_data));
      return _data;
    });
  });
</script>

<!-- footer start-->
<footer class="footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 footer-copyright">
        <p class="mb-0">Copyright 2021-23 © ict All rights reserved.</p>
      </div>
      <div class="col-md-6">
        <p class="pull-right mb-0">
          Hand crafted & made with <i class="fa fa-heart font-secondary" />
        </p>
      </div>
    </div>
  </div>
</footer>
