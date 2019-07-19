<template>
	<view class="">
		<view class="">
			<view>
				<list-nav-bar :title="title"></list-nav-bar>
			</view>
		</view>
		<view class="">
			<view>
				<view>
					<view class="uni-title">源名称</view>
					<view class="uni-list">
						<view class="uni-list-cell"><input class="uni-input" name="name" placeholder="请填写源名称" @keyup.enter="put"
							 @input="put($event)" /></view>
					</view>
				</view>
				<view>
					<view class="uni-title">源地址</view>
					<view class="uni-list">
						<view class="uni-list-cell"><input class="uni-input" name="source" placeholder="请填写源地址" @keyup.enter="search"
							 @input="search($event)" /></view>
					</view>
				</view>
				<view class="uni-btn-v uni-common-mt">
					<button class="btn-submit" type="primary" @click="submit">提交</button>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import uniDrawer from '@dcloudio/uni-ui/lib/uni-drawer/uni-drawer.vue';
	import uniList from '@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
	import uniListItem from '@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

	export default {
		components: {
			uniList,
			uniListItem,
		},
		data() {
			return {
				title: '订阅RSS',
				name: '',
				content: ''
			};
		},
		onLoad() {},
		methods: {
			search(event) {
				if (event.detail.value != null) {
					this.content = event.detail.value;
				}
			},
			put(event){
				if (event.detail.value != null) {
					this.name = event.detail.value;
				}
			},
			submit() {

				this.$axios
					.get('http://tests.com/', {
						params: {
							route: 'rss/add',
							content: this.content,
							title: this.name
						}
					})
					.then(function(response) {
						if (response.data > 0) {
							uni.showToast({
								title: '添加成功'
							});

							let id = response.data;
							uni.navigateTo({
								url: '/pages/rss/detail?id=' + id
							})
						} else {
							switch (response.data) {
								case -1:
									uni.showToast({
										title: '参数错误'
									});
									break;
								case 0:
									uni.showToast({
										title: '添加失败'
									});
									break;
							}
						}


					})
					.catch(function(error) {
						console.log(error);
					});
			}
		}
	};
</script>

<style>
	page {
		height: auto;
		min-height: 100%;
	}

	.uni-card {
		box-shadow: none;
	}

	.uni-list:after {
		height: 0;
	}

	.uni-list:before {
		height: 0;
	}

	.uni-hello-text {
		word-break: break-all;
	}

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
