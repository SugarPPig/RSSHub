<template>
	<view class="">
		<view class="nav">
			<uni-nav-bar
				background-color="#F8F8F8"
				left-icon="bars"
				right-icon="plusempty"
				@click-left="change()"
				@click-right="add()"
				:statusBar="true"
				:shadow="false"
			>
			<view>
				<view ><navigator class="title" url="/"><uni-icon type="home"></uni-icon>{{title}}</navigator></view>
			</view>
			</uni-nav-bar>
		</view>
		<view class="">
			
			<uni-drawer class="tab-left" :visible="myLeft" mode="left" @close="closeDrawer()">
				<uni-list>
					<uni-list-item title="RSS源列表" @click="goSource()" />
					<uni-list-item title="RSS路由列表" @click="goRoute()" />
				</uni-list>
			</uni-drawer>
		</view>
	</view>
</template>

<script>
import uniDrawer from '@/node_modules/@dcloudio/uni-ui/lib/uni-drawer/uni-drawer.vue';
import uniNavBar from '@/node_modules/@dcloudio/uni-ui/lib/uni-nav-bar/uni-nav-bar.vue';
import UniList from '@/node_modules/@dcloudio/uni-ui/lib/uni-list/uni-list.vue';
import uniListItem from '@/node_modules/@dcloudio/uni-ui/lib/uni-list-item/uni-list-item.vue';

export default {
	name: 'listNavBar',
	components: {
		uniDrawer,
		uniNavBar,
		UniList,
		uniListItem
	},
	mounted() {
		this.myLeft = false
	},
	props: {
		title: {
			type: String,
			default: ''
		}
	},
	data() {
		return {
			myLeft: false //data中新增字段
		};
	},
	methods: {
		change() {
			this.myLeft = !this.myLeft;
		},
		add() {
			uni.redirectTo({
				url: '/pages/rss/add'
			});
		},
		changeFalse() {
			this.myLeft = false
		},
		closeDrawer() {
			this.myLeft = false;
		},
		goSource() {
			uni.redirectTo({
				url: '/pages/source/index'
			});
		},
		goRoute() {
			uni.redirectTo({
				url: '/pages/rss/route'
			});
		},
		showMore () {
		}
	},
	watch: {
	}
};
</script>

<style>
.tab-left {
	margin-top: 88upx;
}

.title{
	line-height: 88upx;
	height: 88upx;
	text-align: center;
}
</style>
