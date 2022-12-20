<template>
    <nav class="mt-6">
        <ul class="list-disc">
            <li>
                <!--<Link href="/" class="text-blue-500 hover:underline" :class="{'font-bold underline' : $page.component == 'Home'}">Home</Link>-->
                <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
            </li>
            <li>
                <!--<Link href="/users" class="text-blue-500 hover:underline"  :class="{'font-bold underline' : $page.component == 'Users'}"
                    >Users</Link
                >-->
                <NavLink href="/users" :active="$page.component === 'Users'">Users</NavLink>
            </li>
            <li>
                <!--<Link href="/settings" class="text-blue-500 hover:underline"  :class="{'font-bold underline' : $page.component == 'Settings'}"
                    >Settings</Link
                >-->
                <NavLink href="/settings" :active="$page.component === 'Settings'">Settings</NavLink>
            </li>
            <!--<li>
                <Link
                    href="/logout"
                    method="post"
                    :data="{ foo: 'bar' }"
                    as="button"
                    class="text-blue-500 hover:underline"
                    >Log Out</Link
                >
            </li>-->
        </ul>
    </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
// import NavLink from "@/Shared/NavLink.vue";
import NavLink from "./NavLink.vue";

export default {
    components: { NavLink, Link },
};
</script>
