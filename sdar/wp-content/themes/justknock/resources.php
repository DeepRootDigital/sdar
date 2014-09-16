<?php /* Template Name: Testing Template */ ?>
<?php get_header(); ?>
<div class="body">
  <div class="left-container">
  </div>
  <div class="right-container"> 
  </div>
  <div class="container">
    <div>
      <embed id="pdfview" width="100%" height="100%" name="plugin" src="http://sdar.stats.10kresearch.com/docs/lmu/x/92124Tierrasanta" type="application/pdf">
    </div>
  </div>
</div>
<script src="<?php echo get_template_directory_uri(); ?>/js/pdf.js"></script>
<script type="text/javascript">
window.onload = function() {
  console.log("mew");
  var data = "http://testing.businesslabkit.com/sdar/wp-content/themes/justknock/pdf/92113LoganHeights.pdf";
  //var data = "http://sdar.stats.10kresearch.com/docs/lmu/x/92123SerraMesa";
  console.log(data);
  /*PDFJS.getDocument( data ).then( function(pdf) {
    console.log(pdf);
    pdf.getPage(1).then( function(page){
      console.log(page);
      page.getTextContent().then( function(textContent){
        console.log(textContent);
      });
    });
  });*/
}
</script>
<?php get_footer(); ?>