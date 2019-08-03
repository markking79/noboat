<template>
    <div class="likePack">
        <span v-if="hasLiked" v-on:click="likePack (false)">
            <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(0.56640625) translate(0 0)">
                            <path xmlns="http://www.w3.org/2000/svg" d="M512,179.078c0,43.181-18.609,82.015-48.245,108.922H464L304,448c-16,16-32,32-48,32s-32-16-48-32L48,288h0.245  C18.609,261.093,0,222.259,0,179.078C0,97.849,65.849,32,147.078,32C190.259,32,229.093,50.609,256,80.245  C282.907,50.609,321.741,32,364.922,32C446.15,32,512,97.849,512,179.078z"></path>
                        </g></svg>
        </span>
        <span v-else v-on:click="likePack (true)">
            <svg class="heartSVG" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve"><g transform="translate(5 5) scale(8.1209747251463) translate(-7.144999027252197 -7.145001411437988)">
                            <path xmlns="http://www.w3.org/2000/svg" d="M37.299,10.731c-1.586-0.873-3.379-1.334-5.185-1.334c-2.646,0-5.162,0.967-7.112,2.696  c-1.953-1.729-4.474-2.696-7.119-2.696c-1.801,0-3.593,0.461-5.187,1.336c-3.424,1.896-5.551,5.5-5.551,9.406  c0,1.101,0.172,2.193,0.51,3.248c1.773,7.637,15.946,16.608,16.551,16.987c0.244,0.153,0.521,0.229,0.798,0.229  c0.276,0,0.554-0.078,0.798-0.23c0.604-0.379,14.768-9.352,16.545-16.987c0.336-1.054,0.508-2.146,0.508-3.248  C42.854,16.233,40.727,12.629,37.299,10.731z M39.473,22.523c-0.015,0.046-0.026,0.092-0.038,0.14  C38.321,27.666,29.29,34.497,25.003,37.32c-4.289-2.821-13.322-9.647-14.436-14.656c-0.011-0.048-0.023-0.096-0.039-0.142  c-0.254-0.774-0.383-1.575-0.383-2.382c0-2.815,1.534-5.414,4-6.779c1.146-0.63,2.438-0.963,3.736-0.963  c2.311,0,4.484,1.022,5.968,2.805c0.285,0.343,0.708,0.541,1.153,0.541h0.001c0.446,0,0.869-0.199,1.153-0.543  c1.477-1.781,3.647-2.803,5.957-2.803c1.301,0,2.593,0.333,3.733,0.96c2.47,1.368,4.004,3.966,4.004,6.782  C39.854,20.947,39.726,21.75,39.473,22.523z"></path>
                        </g></svg>
        </span>
        {{likeCount}} likes
    </div>
</template>

<script>
    export default {
        name: 'likePack',
        props: {
          'userHasLiked': {
              type: Boolean,
              default: false
          },
          'userIsLoggedin': {
              type: Boolean,
              default: false
          },
          'packId': {
              type: Number,
              default: 0
          },
            'likeApiUrl': {
                type: String,
                default: ''
            },
            'unlikeApiUrl': {
                type: String,
                default: ''
            },
            'packLikeCount': {
                type: Number,
                default: 0
            }
        },
        data () {
            return {
                hasLiked: this.userHasLiked,
                likeCount: this.packLikeCount
            }
        },
        methods: {
            likePack(liked) {
                if (!this.userIsLoggedin)
                    return;

                this.hasLiked = liked;

                if (this.hasLiked)
                {
                    this.likeCount++;
                    axios.post(this.likeApiUrl, {
                        pack_id: this.packId
                    });
                }
                else
                {
                    this.likeCount--;
                    axios.delete(this.unlikeApiUrl);
                }

            }
        }
    }
</script>

<style>

</style>