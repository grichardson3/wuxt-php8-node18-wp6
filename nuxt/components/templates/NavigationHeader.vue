<template>
    <div id="header" class="header">
        <div id="logoArea" class="header__logoArea">
            <nuxt-link to="/"><img src="/wuxt-logo.svg" alt="Logo"></nuxt-link>
        </div>
        <div id="navigationArea" class="header__navigationArea">
            <nav id="mainNavigation" class="header__mainNavigation">
                <ul id="mainNavigationList" class="header__mainNavigationList">
                    <li 
                        class="header__mainNavigationListItem"
                        v-for="(item, mainMenuIndex) in mainMenuItems"
                        @mouseover="hover = true, hoverIndex = mainMenuIndex"
                        @mouseleave="hover = false, hoverIndex = null"
                        :key="mainMenuIndex"
                    >
                        <nuxt-link class="header__mainNavigationListItemLink" :to="item.url" exact>
                            {{ item.title }}
                        </nuxt-link>
                        <div 
                            class="header__subNavigation"
                            v-for="subItem in subMenuItems"
                            v-if="JSON.stringify(subItem.post_parent) == item.object_id"
                            v-show="hover && hoverIndex == mainMenuIndex"
                        >
                            <div class="header__subNavigationList">
                                <nuxt-link
                                    class="header__subNavigationListLink"
                                    :to="subItem.url"
                                    exact
                                >
                                    {{ subItem.title }}
                                </nuxt-link>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        async fetch(){
            const { route, app } = this.$nuxt.context;
            console.log(route);
            await app.$wp.menu().get()
            .then((data) => {
                Object.values(data).forEach((item) => {
                    if (item.post_parent == 0) {
                        this.mainMenuItems.push({
                            title: item.title,
                            url: 
                                item.url.split("/").filter(e => e !== "")[item.url.split("/").filter(e => e !== "").length - 1] !== ""
                                && item.url.split("/").filter(e => e !== "").length > 3 ?
                                "/" + item.url.split("/").filter(e => e !== "")[item.url.split("/").filter(e => e !== "").length - 1] :
                                "/"
                            ,
                            object_id: item.object_id,
                            post_parent: item.post_parent
                        });
                        if (item.children) {
                            let childrenItems = Object.values(item.children);
                            childrenItems.forEach((childItem) => {
                                this.subMenuItems.push({
                                    title: childItem.title,
                                    url: 
                                        childItem.url.split("/").filter(e => e !== "")[childItem.url.split("/").filter(e => e !== "").length - 1] !== ""
                                        && childItem.url.split("/").filter(e => e !== "").length > 3 ?
                                        "/" + childItem.url.split("/").filter(e => e !== "")[childItem.url.split("/").filter(e => e !== "").length - 1] :
                                        "/"
                                    ,
                                    object_id: childItem.object_id,
                                    post_parent: childItem.post_parent
                                });
                            })
                        }
                    }
                });
            });
        },
        data(){
            return {
                allMenuItems: new Array(),
                mainMenuItems: new Array(),
                subMenuItems: new Array(),
                hover: false
            }
        },
    }
</script>

<style lang="scss">
    .header {
        position: fixed;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        height: 100px;
        z-index: 2;
    }

    .header a {
        color: white;
        text-decoration: none;
    }

    .header ul {
        list-style-type: none;
        display: flex;
        align-items: center;
    }

    .header li {
        padding: 0 12px 0 12px;
    }

    #header {
        background-color: darken(#37495c, 12%);
    }

    .header__logoArea {
        width: 64px;
    }

    .header__mainNavigationListItem {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100px;
    }

    .header__subNavigation {
        position: absolute;
    }

    .header__subNavigationList {
        position: absolute;
        right: -58px;
        top: 42px;
        width: 150px;
        height: 50px;
        padding-top: 20px;
    }

    .header__subNavigationListLink {
        background-color: #393955;
        padding: 12px;
    }
</style>