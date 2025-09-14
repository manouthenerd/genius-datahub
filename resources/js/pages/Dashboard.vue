<script setup lang="ts">
import Folder from '@/components/ui/Folder.vue';
import ResourcesLayout from '@/layouts/dashboard/ResourcesLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineOptions({ layout: ResourcesLayout });

interface Service {
    id: number;
    name: string;
    updated_at: string;
}

defineProps<{ services: Service[] }>();

const page = usePage();
const user = page.props.auth?.user;

const getUser = computed(() => {
    return user?.role;
});
</script>

<template>
    <table v-if="getUser == 'admin'" class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
        <tbody>
            <tr class="flex flex-wrap gap-2 p-2">
                <Link
                    v-for="service in services"
                    :key="service.id"
                    :href="route('resources.folders', [service.id])"
                    class="grid justify-items-center"
                >
                    <Folder />
                    <p class="w-[130px] overflow-hidden text-center text-xs text-nowrap text-ellipsis">
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
