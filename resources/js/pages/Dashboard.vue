<script setup lang="ts">

import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import Folder from '@/components/ui/Folder.vue';
import ResourcesLayout from '@/layouts/dashboard/ResourcesLayout.vue';

defineOptions({ layout: ResourcesLayout })

interface Service {
    id: number,
    name: string,
    updated_at: string
}


defineProps<{ services: Service[] }>();

const page = usePage();
const user = page.props.auth?.user;

const getUser = computed(() => {
    return user?.role
});
</script>

<template>

    <table v-if="getUser == 'admin'" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <!-- TODO Faire passer les avatars en dessous du thead -->
        <tbody>
            <tr class="flex flex-wrap gap-2 p-2">
                <Link v-for="service in services" :key="service.id" :href="route('resources.folders', [service.id])"
                    class="grid justify-items-center">
                <Folder />
                <p class="w-[130px] text-ellipsis text-center text-nowrap overflow-hidden text-xs">
                    {{ service.name }}
                </p>
                </Link>
            </tr>
        </tbody>
    </table>

    <!-- TODO Injecter les données dans le tableau -->
    <!-- <ExplorerTable v-if="getUser == 'member' || getUser == 'moderator'">

    </ExplorerTable> -->

</template>
