<template>
	<view class="">
		<view class="">
			<list-nav-bar :title="title"></list-nav-bar>
		</view>
		<view class="" v-for="(item, index) in channel" :key="index">
			<h2>{{ item['sub-title'] }}</h2>
			<!-- 			<view type="button" v-clipboard:copy="item['sub-url']" v-clipboard:success="onSuccess('成功回调')" :class="btn">
				{{item['sub-url']}}
			</view> -->
			<view :data-index="index" :class="{changeStyle:changeSelectStyle == index}" v-clipboard:copy="title+'__'+item['sub-title']+'__'+item['sub-url']" v-clipboard:success="onCopy" v-clipboard:error="onErrorr">{{item['sub-url']}}</view>
		</view>
	</view>
</template>

<script>

	export default {
		components: {
		},
		data() {
			return {
				channel: [],
				title: '',
				changeSelectStyle: -1
			};
		},
		onLoad() {
			let channel = this.$route.query['channel'];
			this.getData(channel);
			this.title = this.$route.query['category'] + '__' + channel;
		},
		methods: {
			getData(channel) {
				var data = uni.getStorageSync(channel);
				if (!data) {
					this.getChannel(channel);
				}
				this.channel = data;
			},
			getChannel(channel) {
				this.$axios
					.get('http://tests.com/', {
						params: {
							channel: channel
						}
					})
					.then(response => {
						this.channel = response.data;
						console.log(this.channel)
						uni.setStorageSync(channel, this.channel);
					})
					.catch(function(error) {
						console.log(error);
					});
			},
			onCopy(e) {
				// console.log(e)
				this.changeSelectStyle = e.trigger.dataset.index;
			},
			onErrorr(){
				
			}
		}
	};
</script>

<style>
	.changeStyle {
		color: red;
	}
</style>
