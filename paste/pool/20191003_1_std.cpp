
#include <bits/stdc++.h>
using namespace std;


bool roundup(int i, int n) {
    return (int)floor(1.0 * i / n * 100 + 0.5) == (int) floor(1.0 * i / n * 100) + 1;
}

vector <int> b, need;

bool cmp(int i, int j) {
    return need[i] < need[j];
}

int main() {
    
	freopen("round.in", "r", stdin);
	freopen("round.out", "w", stdout);
    int T, ca = 1;
    scanf("%d", &T);
    
    while (T--) 
    {
        
        int n, m;
        scanf("%d%d",&n,&m);
        vector <int> a(m);
        int sum = 0;
        for (int i = 0; i < m; i++) {
            scanf("%d", &a[i]);
            sum += a[i];
        }
        vector<int> ups;
        int mi = -1;
        for (int i = 1; i <= n; i++) {
            if (roundup(i, n)) {
                ups.push_back(i);
                if(mi == -1) {
                    mi = i;
                }
            }
        }
        int remain = n - sum;
        b = a;
        need = vector<int>(m, 0);
        vector <int> id(m);
        for (int i = 0; i < m; i++) {
            id[i] = i;
            int pos = lower_bound(ups.begin(), ups.end(), a[i]) - ups.begin();
            if(pos != (int)ups.size()) {
                int dist = ups[pos] - a[i];
                need[i] = dist;
            } 
        }
        sort (id.begin(), id.end(), cmp);
        
        for (int i = 0; i < m; i++) {
            if (need[id[i]] < mi && remain >= need[id[i]]) {
                b[id[i]] += need[id[i]];
                remain -= need[id[i]];
            }
        }
        if (mi != -1) {
            while (remain >= mi) {
                b.push_back(mi);
                remain -= mi;
            }
        }
        if (remain) {
            b.push_back(remain);
        }

        /*
        for (auto it : b) {
            cout << it << " " ;
        }
        cout << endl;
        */
        int ret = 0;
        for (int i = 0; i < (int)b.size(); i++) {
            ret += (int)  floor(1.0 * b[i] / n * 100+ 0.5);
        }
        printf("Case #%d: %d\n",ca++, ret);
    }
    return  0;
}