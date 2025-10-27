<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import { Button } from '@/components/ui/button';
import { Sheet, SheetContent, SheetHeader, SheetTrigger } from '@/components/ui/sheet';
import type { BreadcrumbItemType } from '@/types';
import { usePage, router } from '@inertiajs/vue3';
import { Bell, Mail, MailOpen } from 'lucide-vue-next';
import { ref } from 'vue';

const notifications = ref(usePage().props.notifications);

const selectedNotifications = ref<number[]>([]);

const toggleSelection = (id: number) => {
    if (selectedNotifications.value.includes(id)) {
        selectedNotifications.value = selectedNotifications.value.filter(i => i !== id);
    } else {
        selectedNotifications.value.push(id);
    }
};

const markAsRead = (id: number, isRead: boolean) => {
    router.post(route('notifications.markAsRead'), {
        notification_ids: [id],
        is_read: isRead,
    }, { preserveScroll: true });
};

const deleteSelected = () => {
    if (selectedNotifications.value.length === 0) return;
    router.post(route('notifications.markAsDeleted'), {
        notification_ids: selectedNotifications.value,
    }, { preserveScroll: true });
    selectedNotifications.value = [];
};

const markAllAsRead = () => {
    const ids = notifications.value.map(n => n.id);
    router.post(route('notifications.markAsRead'), {
        notification_ids: ids,
        is_read: true,
    }, { preserveScroll: true });
};


interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}


withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <div class="flex items-center justify-between">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <Sheet>
                    <SheetTrigger>
                        <Button class="mr-4">
                            <Bell />
                        </Button>
                    </SheetTrigger>
                    <SheetContent>
                        <SheetHeader class="mt-6">
                            <div class="bg-neutral-200 p-2 rounded-sm flex justify-between items-center">
                                <span class="font-bold">Notifications</span>

                                <a as="button" @click="markAllAsRead" class="font-thin underline text-xs"
                                    :class="!notifications.length ? 'cursor-not-allowed pointer-events-none' : 'cursor-pointer'">
                                    Marquer
                                    tout comme lu</a>
                            </div>
                        </SheetHeader>
                        <div class="flex w-full justify-end">
                            <Button @click="deleteSelected" variant="outline"
                                class="border border-slate-300 text-red-500! mr-4"
                                :disabled="!notifications.length">Supprimer</Button>
                        </div>
                        <div v-if="notifications.length"
                            class="p-2 mx-4 border border-slate-300 rounded h-full space-y-2 divide-y-2 overflow-y-scroll">
                            <div v-for="notif in notifications" :key="notif.id"
                                class="rounded p-3 transition-all hover:bg-[antiquewhite] flex">
                                <div v-if="!notif.is_read">
                                    <span class="h-[5px] bg-orange-400 block w-[5px] rounded-full"></span>
                                </div>
                                <div>
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <div class="flex w-full gap-1 justify-between items-center">
                                                <p class="flex gap-1 items-center">
                                                    <span
                                                        class="h-[18px] w-[18px] block bg-gradient-to-bl from-blue-300 to-green-400 via-orange-400 rounded-full"></span>
                                                    <span class="font-[500]">{{ notif.title }}</span>
                                                </p>

                                                <div class="flex gap-2 items-center">
                                                    <span @click="markAsRead(notif.id, !notif.is_read)"
                                                        class="cursor-pointer">
                                                        <Mail v-if="!notif.is_read" fill="darkorange" :size="22" />
                                                        <MailOpen v-else :size="19" />
                                                    </span>
                                                    <input type="checkbox" class="w-[17.5px] h-[17.5px]"
                                                        :checked="selectedNotifications.includes(notif.id)"
                                                        @change="toggleSelection(notif.id)" />
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-xs font-thin">
                                            {{ notif.created_at }}
                                        </p>
                                    </div>
                                    <div class="my-2 text-sm">
                                        <p>{{ notif.content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else class="w-full flex flex-col justify-center mt-8 space-y-3">
                            <img class="h-[170px]" src="/image/notification.svg" alt="notification illustration">
                            <p
                                class="text-xs p-0.5 underline text-center mt-4 bg-orange-400 rounded w-fit flex my-0 mx-auto">
                                Pas de notifications disponible.
                            </p>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>
            <slot />
        </AppContent>
    </AppShell>
</template>
