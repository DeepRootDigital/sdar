<?php /* Template Name: NeighborhoodsCoords Template */ ?>
<?php get_header(); ?>

      <?php 
        $args = array(
          'post_type' => 'neighborhoods', 'orderby'=> 'title', 'order' => 'ASC'
        );
        $wp_query = new WP_Query($args); 
        $neighborhoodsarray = array();
        while ($wp_query->have_posts()) : $wp_query->the_post();
          array_push($neighborhoodsarray, array(
            "neighborhood_name" => get_the_title(),
            "neighborhood_latlong" => get_post_meta(get_the_ID(), 'latlong', true)
          ));
        endwhile;
      ?>
<script type="text/javascript">
  window.onload = function() {
    var neighborhoods = <?php echo json_encode($neighborhoodsarray); ?>;
    neighborhoods.forEach(function(neighborhood){
      if (neighborhood.neighborhood_latlong && neighborhood.neighborhood_latlong.length > 0) {
        var lat = neighborhood.neighborhood_latlong.split(",")[0].trim();
        var long = neighborhood.neighborhood_latlong.split(",")[1].trim();
      } else {
        var lat = "32.8245525";
        var long = "-117.0951632";
      }
      $.ajax({
        url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/auth.php",
        type : "POST",
        data : {
          uid : "colpan"
        },
        error : function(jqXHR, textStatus, errorThrown) {
          console.error(textStatus + ' ' + errorThrown);
        },
        success : function(data) {
          var token = data;
          $.ajax({
            url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getlocation.php",
            type : "POST",
            data : {
              longitude : long,
              latitude : lat,
              token : token
            },
            error : function(jqXHR, textStatus, errorThrown) {
              console.error(textStatus + ' ' + errorThrown);
            },
            success : function(data) {
              data = JSON.parse(data).response.result.package;
              var neighborhoodid;
              data.item.every(function(areas){
                if (areas.name == neighborhood.neighborhood_name) {
                  neighborhoodid = areas.id;
                  return false;
                }
              });
              if (!neighborhoodid || neighborhoodid.length == 0) {
                neighborhoodid = data.item[0].id;
              }
              $.ajax({
                url : "http://testing.businesslabkit.com/sdarapi/onboardinformatics/getBoundary.php",
                type : "POST",
                data : {
                  aid: neighborhoodid,
                  token : token
                },
                error : function(jqXHR, textStatus, errorThrown) {
                  console.error(textStatus + ' ' + errorThrown);
                },
                success : function(data) {
                  var coords = JSON.parse(data).response.result.package.item[0].boundary.split("((")[1].split("))")[0].split(",");
                  coord = coords.join();
                  $.ajax({
                    url : "http://testing.businesslabkit.com/sdarapi/coords.php",
                    type : "POST",
                    data : {
                      name: neighborhood.neighborhood_name,
                      coords: coord
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                      console.error(textStatus + ' ' + errorThrown);
                    },
                    success : function(data) {
                      console.log(data);
                    }
                  });
                }
              });
            }
          });
        }
      });
    });
  } 
</script>
<?php get_footer(); ?>