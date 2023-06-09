$(document).ready(function () {
  // Create a timeline for the hotspot transitions
  var hotspot_tl = gsap.timeline({ paused: true });

  // Set initial states for elements
  gsap.set(".interactive-map #close-map", { autoAlpha: 0 });
  gsap.set(".text-info:not(.area-info-active)", { autoAlpha: 0 });
  gsap.set("#common-info", { autoAlpha: 1 });

  function zoomToCenter(zoomMe) {
    // Function to calculate the center of the zoomed element
    // Modify this function based on your specific requirements
    // ...

    return { x: x, y: y };
  }

  $(".hotspot").on("click", function () {
    var hotspot = $(this);
    var hotspotRegion = hotspot.attr("id");
    var hotspotZoomRegionId = "#" + hotspotRegion + "-zoom";
    var textInfo = "#" + hotspotRegion + "-info";
    var zoomEl = document.getElementById(hotspotRegion + "-zoom");

    var zoomVanish = $(".vanish-on-zoom").not(hotspotZoomRegionId);
    $("#common-info").removeClass("area-info-active");
    $(textInfo).addClass("area-info-active");
    $("#close-map").addClass(hotspotRegion + "-zoom");

    hotspot_tl
      .to(zoomVanish, { duration: 1, autoAlpha: 0, ease: "sine.out" })
      .to(hotspotZoomRegionId, { duration: 1, autoAlpha: 1, ease: "sine.out" });

    // Call the zoomToCenter function to calculate the center coordinates
    var center = zoomToCenter(zoomEl);

    // Use GSAP to animate the SVG map to the center coordinates
    gsap.to("#svgContainer", { duration: 1, x: center.x, y: center.y, scale: 2 });
  });

  // Add click event listeners to the zoom-out buttons
  $(".interactive-map").on("click", ".svg-zoom-out", function () {
    hotspot_tl.reverse();
    gsap.to("#svgContainer", { duration: 1, x: 0, y: 0, scale: 1 });
  });
});
