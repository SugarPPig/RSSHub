<template>
	<view class="">
		<view class="">
			<list-nav-bar :title="title"></list-nav-bar>
		</view>
		<view class="">
			<uni-list v-for="(item,index) in route" :key="index">
				<uni-list-item @click="getList(item['url'])" :show-badge="true" :badge-text="2222" :title="item.title" :note="item.sub"/>
			</uni-list>
		</view>
	</view>
</template>

<script>
	import UniList from '@/node_modules/@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
	import uniListItem from '@/node_modules/@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

	export default {
		components: {
			UniList,
			uniListItem
		},
		data() {
			return {
				title: 'RSS路由列表',
				route: ''
			};
		},
		onLoad() {
			this.getData();
		},
		methods: {
			getData() {
				this.$axios
					.get('http://tests.com/', {
						params: {
							route: 'rss/route'
						}
					})
					.then(response => {
						this.route = response.data;
					})
					.catch(function(error) {
						console.log(error);
					});
			},
			getList(url){
				uni.navigateTo({
					url:'/pages/rss/list?url='+url
				})
			}
		},
		onPullDownRefresh() {
			console.log('onPullDownRefresh');
			setTimeout(function() {
				uni.stopPullDownRefresh();
				console.log('stopPullDownRefresh');
			}, 1000);
		}
	};
</script>

<style>
	.content {
		text-align: center;
		height: 400upx;
	}

	.logo {
		height: 200upx;
		width: 200upx;
		margin-top: 200upx;
	}

	.title {
		font-size: 36upx;
		color: #8f8f94;
	}
</style>
