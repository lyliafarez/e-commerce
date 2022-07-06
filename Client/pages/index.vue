<template>
 <div class="">
   <div class="hero-section">
        <hero-section/>
   </div>
   <div class="features-section">
      <features-section/>
   </div>
   <div class="testimonail-section">
     <testimonail-section/>
   </div>
   <div class="cta-section">
     <cta-section/>
   </div>
   <div class="footer">
     <foot-bar/>
   </div>
   

 </div>

</template>

<script>
import CtaSection from '../components/CtaSection.vue'
import FeaturesSection from '../components/FeaturesSection.vue'
import HeroSection from '../components/HeroSection.vue'
import TestimonailSection from '../components/TestimonailSection.vue'
import FootBar from '../components/FootBar.vue'
export default {
  components: { HeroSection, FeaturesSection, TestimonailSection, CtaSection , FootBar,},
  name: 'IndexPage'
}
</script>
