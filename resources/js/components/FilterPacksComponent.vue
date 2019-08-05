<template>
    <div>

        <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupPackWeight" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Weight ({{weightDisplayText}})
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupPackWeight">
                    <a v-for="item in weightData" v-bind:class="{ active: item.is_selected}" class="dropdown-item"  v-bind:href="weightFullHref (item)">{{item.title}}</a>
                </div>
            </div>

            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupPackPrice" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Price ({{priceDisplayText}})
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupPackPrice">
                    <a v-for="priceItem in priceData" v-bind:class="{ active: priceItem.is_selected}" class="dropdown-item"  v-bind:href="priceFullHref (priceItem)">{{priceItem.title}}</a>
                </div>
            </div>

            <div class="btn-group btn-group-sm" role="group">
                <button id="btnGroupPackSeason" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Season ({{seasonDisplayText}})
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupPackSeason">
                    <a v-for="seasonItem in seasonData" v-bind:class="{ active: seasonItem.is_selected}" class="dropdown-item"  v-bind:href="seasonFullHref (seasonItem)">{{seasonItem.title}}</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'filterPacks',
        props: {
            'weightData': {
                type: Array
            },
            'priceData': {
                type: Array
            },
            'seasonData': {
                type: Array
            }
        },
        data () {
            return {
                weightDisplayText: '',
                priceDisplayText: '',
                seasonDisplayText: ''
            }
        },
        methods: {
            setActiveWeight() {
                for (const weightItem of this.weightData){
                    if (weightItem.is_selected)
                        this.weightDisplayText = weightItem.title;
                }
            },
            weightFullHref: function (item) {
                return '?pack_filter_ounces_min='+item.min+'&pack_filter_ounces_max='+item.max;
            },
            setActivePrice() {
                for (const priceItem of this.priceData){
                    if (priceItem.is_selected)
                        this.priceDisplayText = priceItem.title;
                }
            },
            priceFullHref: function (priceItem) {
                return '?pack_filter_cost_min='+priceItem.min+'&pack_filter_cost_max='+priceItem.max;
            },
            setActiveSeason() {
                for (const seasonItem of this.seasonData){
                    if (seasonItem.is_selected)
                        this.seasonDisplayText = seasonItem.title;
                }
            },
            seasonFullHref: function (priceItem) {
                return '?pack_filter_season_id='+priceItem.id;
            }
        },
        mounted() {
            this.setActiveWeight ();
            this.setActivePrice ();
            this.setActiveSeason ();
        }
    }
</script>

<style>

</style>