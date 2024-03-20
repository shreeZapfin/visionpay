// vite.config.js
import { defineConfig } from "file:///C:/xampp/htdocs/Starter-Kit/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/xampp/htdocs/Starter-Kit/node_modules/laravel-vite-plugin/dist/index.mjs";
import { viteStaticCopy } from "file:///C:/xampp/htdocs/Starter-Kit/node_modules/vite-plugin-static-copy/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: [
        // Resources paths
        "resources/css/app.css",
        "resources/sass/app.scss",
        "resources/js/app.js",
        // Resources assets js file paths
        "resources/assets/js/add-products",
        "resources/assets/js/advancedform",
        "resources/assets/js/alerts",
        "resources/assets/js/apexchart",
        "resources/assets/js/authentication-main",
        "resources/assets/js/authentication",
        "resources/assets/js/blog-post",
        "resources/assets/js/canada",
        "resources/assets/js/carousel",
        "resources/assets/js/cart",
        "resources/assets/js/chart",
        "resources/assets/js/chartjs-charts",
        "resources/assets/js/charts",
        "resources/assets/js/chat",
        "resources/assets/js/Check-out",
        "resources/assets/js/checkbox-selectall",
        "resources/assets/js/color-picker",
        "resources/assets/js/construction",
        "resources/assets/js/content-scroll",
        "resources/assets/js/custom-switcher",
        "resources/assets/js/datatable",
        "resources/assets/js/defaultmenu",
        "resources/assets/js/echarts",
        "resources/assets/js/email-ibox",
        "resources/assets/js/form-elements",
        "resources/assets/js/form-layout",
        "resources/assets/js/form-validation",
        "resources/assets/js/formelementadvnced",
        "resources/assets/js/fullcalendar",
        "resources/assets/js/gallery",
        "resources/assets/js/gmaps",
        "resources/assets/js/google-maps",
        "resources/assets/js/grid",
        "resources/assets/js/index1",
        "resources/assets/js/jvectormap",
        "resources/assets/js/landing",
        "resources/assets/js/map-leafleft",
        "resources/assets/js/modal",
        "resources/assets/js/notifications",
        "resources/assets/js/nouislider",
        "resources/assets/js/profile",
        "resources/assets/js/quill-editor",
        "resources/assets/js/range",
        "resources/assets/js/rangeslider",
        "resources/assets/js/ratings",
        "resources/assets/js/russia",
        "resources/assets/js/select2",
        "resources/assets/js/setting",
        "resources/assets/js/show-code",
        "resources/assets/js/simplebar",
        "resources/assets/js/slider",
        "resources/assets/js/spain",
        "resources/assets/js/sweet-alert",
        "resources/assets/js/swiper",
        "resources/assets/js/table-data",
        "resources/assets/js/themeColors",
        "resources/assets/js/toast",
        "resources/assets/js/treeview",
        "resources/assets/js/us-merc-en",
        "resources/assets/js/widget",
        "resources/assets/js/wishlist"
      ],
      refresh: true
    }),
    viteStaticCopy({
      targets: [
        {
          src: [
            "resources/css/app.css",
            "resources/sass/app.scss",
            "resources/js/app.js",
            "resources/assets/images/",
            "resources/assets/libs/",
            "resources/assets/iconfonts/",
            "resources/assets/js/sticky.js",
            "resources/assets/js/main.js",
            "resources/assets/js/checkbox-selectall.js",
            "resources/assets/js/index1.js",
            "resources/assets/js/under-maintenance.js",
            "resources/assets/js/show-password.js",
            "resources/assets/js/filemanager-list.js",
            "resources/assets/js/apexcharts-stock-prices.js"
          ],
          dest: "assets/"
        }
      ]
    }),
    {
      name: "blade",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".blade.php")) {
          server.ws.send({
            type: "full-reload",
            path: "*"
          });
        }
      }
    }
  ],
  build: {
    chunkSizeWarningLimit: 1600
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFx4YW1wcFxcXFxodGRvY3NcXFxcU3RhcnRlci1LaXRcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkM6XFxcXHhhbXBwXFxcXGh0ZG9jc1xcXFxTdGFydGVyLUtpdFxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vQzoveGFtcHAvaHRkb2NzL1N0YXJ0ZXItS2l0L3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB7IHZpdGVTdGF0aWNDb3B5IH0gZnJvbSAndml0ZS1wbHVnaW4tc3RhdGljLWNvcHknXG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbXG5cbiAgICAgICAgICAgICAgICAvLyBSZXNvdXJjZXMgcGF0aHNcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9zYXNzL2FwcC5zY3NzJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHAuanMnLFxuXG4gICAgICAgICAgICAgICAgLy8gUmVzb3VyY2VzIGFzc2V0cyBqcyBmaWxlIHBhdGhzXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvYWRkLXByb2R1Y3RzJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvYWR2YW5jZWRmb3JtJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvYWxlcnRzJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvYXBleGNoYXJ0JywgIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2F1dGhlbnRpY2F0aW9uLW1haW4nLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9hdXRoZW50aWNhdGlvbicsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2Jsb2ctcG9zdCcsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2NhbmFkYScsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2Nhcm91c2VsJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY2FydCcsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2NoYXJ0JywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY2hhcnRqcy1jaGFydHMnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9jaGFydHMnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9jaGF0JywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvQ2hlY2stb3V0JywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY2hlY2tib3gtc2VsZWN0YWxsJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY29sb3ItcGlja2VyJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY29uc3RydWN0aW9uJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY29udGVudC1zY3JvbGwnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9jdXN0b20tc3dpdGNoZXInLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9kYXRhdGFibGUnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9kZWZhdWx0bWVudScsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2VjaGFydHMnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9lbWFpbC1pYm94JyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9mb3JtLWVsZW1lbnRzJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvZm9ybS1sYXlvdXQnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9mb3JtLXZhbGlkYXRpb24nLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9mb3JtZWxlbWVudGFkdm5jZWQnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9mdWxsY2FsZW5kYXInLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9nYWxsZXJ5JywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvZ21hcHMnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9nb29nbGUtbWFwcycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL2dyaWQnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9pbmRleDEnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9qdmVjdG9ybWFwJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvbGFuZGluZycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL21hcC1sZWFmbGVmdCcsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL21vZGFsJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvbm90aWZpY2F0aW9ucycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL25vdWlzbGlkZXInLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9wcm9maWxlJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvcXVpbGwtZWRpdG9yJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvcmFuZ2UnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9yYW5nZXNsaWRlcicsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3JhdGluZ3MnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9ydXNzaWEnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9zZWxlY3QyJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvc2V0dGluZycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3Nob3ctY29kZScsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3NpbXBsZWJhcicsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3NsaWRlcicsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3NwYWluJywgXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvc3dlZXQtYWxlcnQnLCBcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9zd2lwZXInLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3RhYmxlLWRhdGEnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3RoZW1lQ29sb3JzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy90b2FzdCcsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvdHJlZXZpZXcnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3VzLW1lcmMtZW4nLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3dpZGdldCcsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvd2lzaGxpc3QnLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgICAgICB2aXRlU3RhdGljQ29weSh7XG4gICAgICAgICAgICB0YXJnZXRzOiBbXG4gICAgICAgICAgICAgIHtcbiAgICAgICAgICAgICAgICBzcmM6IChbXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvc2Fzcy9hcHAuc2NzcycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvYXBwLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9pbWFnZXMvJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9saWJzLycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvaWNvbmZvbnRzLycsIFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3N0aWNreS5qcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvbWFpbi5qcycsXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9hc3NldHMvanMvY2hlY2tib3gtc2VsZWN0YWxsLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9pbmRleDEuanMnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvYXNzZXRzL2pzL3VuZGVyLW1haW50ZW5hbmNlLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9zaG93LXBhc3N3b3JkLmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9maWxlbWFuYWdlci1saXN0LmpzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Fzc2V0cy9qcy9hcGV4Y2hhcnRzLXN0b2NrLXByaWNlcy5qcycsXG4gICAgICAgICAgICBdKSxcbiAgICAgICAgICAgICAgICBkZXN0OiAnYXNzZXRzLydcbiAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgXVxuICAgICAgICB9KSxcbiAgICAgICAge1xuICAgICAgICAgICAgbmFtZTogJ2JsYWRlJyxcbiAgICAgICAgICAgIGhhbmRsZUhvdFVwZGF0ZSh7IGZpbGUsIHNlcnZlciB9KSB7XG4gICAgICAgICAgICAgICAgaWYgKGZpbGUuZW5kc1dpdGgoJy5ibGFkZS5waHAnKSkge1xuICAgICAgICAgICAgICAgICAgICBzZXJ2ZXIud3Muc2VuZCh7XG4gICAgICAgICAgICAgICAgICAgICAgICB0eXBlOiAnZnVsbC1yZWxvYWQnLFxuICAgICAgICAgICAgICAgICAgICAgICAgcGF0aDogJyonLFxuICAgICAgICAgICAgICAgICAgICB9KTtcbiAgICAgICAgICAgICAgICB9XG4gICAgICAgICAgICB9LFxuICAgICAgICB9XG4gICAgXSxcbiAgICBidWlsZDoge1xuICAgICAgICBjaHVua1NpemVXYXJuaW5nTGltaXQ6IDE2MDAsXG4gICAgfSxcbn0pO1xuXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQTJRLFNBQVMsb0JBQW9CO0FBQ3hTLE9BQU8sYUFBYTtBQUNwQixTQUFTLHNCQUFzQjtBQUUvQixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUE7QUFBQSxRQUdIO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQTtBQUFBLFFBR0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxNQUNKO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsSUFDRCxlQUFlO0FBQUEsTUFDWCxTQUFTO0FBQUEsUUFDUDtBQUFBLFVBQ0UsS0FBTTtBQUFBLFlBQ047QUFBQSxZQUNBO0FBQUEsWUFDQTtBQUFBLFlBQ0E7QUFBQSxZQUNBO0FBQUEsWUFDQTtBQUFBLFlBQ0E7QUFBQSxZQUNBO0FBQUEsWUFDQTtBQUFBLFlBQ0E7QUFBQSxZQUNBO0FBQUEsWUFDQTtBQUFBLFlBQ0E7QUFBQSxZQUNBO0FBQUEsVUFDSjtBQUFBLFVBQ0ksTUFBTTtBQUFBLFFBQ1I7QUFBQSxNQUNGO0FBQUEsSUFDSixDQUFDO0FBQUEsSUFDRDtBQUFBLE1BQ0ksTUFBTTtBQUFBLE1BQ04sZ0JBQWdCLEVBQUUsTUFBTSxPQUFPLEdBQUc7QUFDOUIsWUFBSSxLQUFLLFNBQVMsWUFBWSxHQUFHO0FBQzdCLGlCQUFPLEdBQUcsS0FBSztBQUFBLFlBQ1gsTUFBTTtBQUFBLFlBQ04sTUFBTTtBQUFBLFVBQ1YsQ0FBQztBQUFBLFFBQ0w7QUFBQSxNQUNKO0FBQUEsSUFDSjtBQUFBLEVBQ0o7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNILHVCQUF1QjtBQUFBLEVBQzNCO0FBQ0osQ0FBQzsiLAogICJuYW1lcyI6IFtdCn0K
