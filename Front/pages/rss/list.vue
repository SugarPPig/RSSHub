<template>
	<view class="">
		<view>
			<list-nav-bar :title="title"></list-nav-bar>
		</view>

		<view>
			<uni-list v-for="(item,index) in list" :key="index">
				<uni-list-item :show-badge="true" :badge-text="12" :title="item.title" :note="item.description" @click='jump(item.link)' />
			</uni-list>
		</view>
		<view v-if="isShow">
			<web-view ref="web" :src="src"></web-view>
		</view>
	</view>
</template>

<script>
	import uniIcon from '@dcloudio/uni-ui/lib/uni-icon/uni-icon.vue';
	import uniList from '@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
	import uniListItem from '@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

	export default {
		components: {
			uniIcon,
			uniList,
			uniListItem
		},
		data() {
			return {
				isShow: false,
				url: '',
				title: '',
				rss: '',
				list: '',
				src: ''
			};
		},
		onLoad() {
			this.url = this.$route.query['url'];
			console.log(this.url)
			let data = uni.getStorageSync(this.url);
			if (!data) {
				this.request();
			} else {
				this.rss = data.rss;
				this.title = this.rss.channel.title;
				this.list = this.rss.channel.item;
			}
		},
		methods: {
			request() {
				this.$axios
					.get(this.url)
					.then(response => {
						var jsonObj = this.$x2js.xml2js(response.data);
						this.rss = jsonObj.rss;
						this.title = this.rss.channel.title;
						this.list = this.rss.channel.item;
						console.log(this.rss)
						uni.setStorageSync(this.url, jsonObj)
					})
					.catch(function(error) {
						console.log(error);
					});
			},
			jump(url) {
				this.isShow = true;
				setTimeout(() => {
					this.src = url;
				}, 0)
			}
		},
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

	.nav {
		/* width: 80%; */
		/* margin:0 auto; */
	}

	.tab-left {
		margin-top: 88upx;
	}
</style>
