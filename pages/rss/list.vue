<template>
	<view class="">
		<view class="nav"><uni-nav-bar background-color="#F8F8F8" left-icon="bars" right-icon="undo" title="RSSHub" @click-left="show()" @click-right="back()" :statusBar="true" :shadow="false" /></view>

		<view>
			<uni-drawer class="tab-left" mode="left" @close="closeDrawer()">
				<uni-list>
					<uni-list-item title="Item1" />
					<uni-list-item title="Item2" />
				</uni-list>
			</uni-drawer>
		</view>

		<view class="" @click="list()">
			<uni-list>
				<uni-list-item :show-arrow="false" title="标题文字" note="描述信息" />
				<uni-list-item title="标题文字" note="描述信息" />
				<uni-list-item :show-badge="true" :badge-text="12" title="标题文字" note="描述信息" />
			</uni-list>
		</view>
	</view>
</template>

<script>
import uniDrawer from '@dcloudio/uni-ui/lib/uni-drawer/uni-drawer.vue';
import uniNavBar from '@dcloudio/uni-ui/lib/uni-nav-bar/uni-nav-bar.vue';
import uniList from '@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
import uniListItem from '@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

export default {
	components: {
		uniDrawer,
		uniNavBar,
		uniIcon,
		uniList,
		uniListItem
	},
	data() {
		return {
		};
	},
	onLoad() {},
	methods: {
		request() {
			var _this = this;
			this.$axios
				.get('https://rsshub.app/bilibili/bangumi/media/9192')
				.then(function(response) {
					var jsonObj = _this.$x2js.xml2js(response.data);
					console.log(response);
					console.log(jsonObj);
				})
				.catch(function(error) {
					console.log(error);
				});
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

.nav {
	/* width: 80%; */
	/* margin:0 auto; */
}

.tab-left {
	margin-top: 88upx;
}
</style>
