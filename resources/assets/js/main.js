import Vue from 'vue';
import vueResource from 'vue-resource';
import vueAsyncData from 'vue-async-data';

Vue.use(vueResource);
Vue.use(vueAsyncData);

var App = new Vue({
  el: 'body',
  components: {
  },
  ready() {
  },
  methods: {

      getPhotos() {
          return this.$http.get('/api/photos').then((response) => {
             return response.json();
          }, (response) => {
             return response.json();
          });
      },

      createTimeout() {
        setTimeout(() => {
            this.updateData();
        }, this.timeout * 1000);
      },

      updateData() {
          let data = this.getPhotos();
          this.$set('$loadingAsyncData', true);
          data.then((response) => {
             for (var key in response) {
                 this.$set(key, response[key]);
             }
             this.$set('$loadingAsyncData', false);
             this.$emit('async-data');
          });
      },

      loadSalvattore() {
          salvattore.recreateColumns(document.querySelector('#grid'));
          this.createTimeout();
      }

  },
  events: {
      'async-data': function() {
          this.$nextTick(() => {
              this.loadSalvattore();
          });
      }
  },
  data: {
      photos: [],
      timeout: 60
  },
  asyncData: function () {
      return this.getPhotos();
  }
});
