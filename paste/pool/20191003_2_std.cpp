#include <bits/stdc++.h>

using namespace std;

int main() {
	freopen("sign.in", "r", stdin);
	freopen("sign.out", "w", stdout);
  int tt;
  //cin >> tt;
  //for (int qq = 1; qq <= tt; qq++) 
  {
    //cout << "Case #" << qq << ": ";
    int n;
    cin >> n;
    vector<int> a(n), b(n);
    for (int i = 0; i < n; i++) {
      int x, y, z;
      cin >> x >> y >> z;
      a[i] = x + y;
      b[i] = x - z;
    }
    map<int,int> ma;
    map<int,int> mb;
    map< pair<int,int>,int > mab;
    int j = 0;
    int last_a = -1, last_b = -1;
    int ans = -1, ways = -1;
    for (int i = 0; i < n; i++) {
      ma[a[i]]++;
      mb[b[i]]++;
      mab[make_pair(a[i], b[i])]++;
      if (i > 0 && a[i] != a[i - 1]) {
        last_a = i - 1;
      }
      if (i > 0 && b[i] != b[i - 1]) {
        last_b = i - 1;
      }
      while (j <= i) {
        if (last_a < j || last_b < j) {
          break;
        }
        int cnt = ma[a[i]] + mb[b[last_a]] - mab[make_pair(a[i], b[last_a])];
        if (cnt == i - j + 1) {
          break;
        }
        cnt = ma[a[last_b]] + mb[b[i]] - mab[make_pair(a[last_b], b[i])];
        if (cnt == i - j + 1) {
          break;
        }
        ma[a[j]]--;
        mb[b[j]]--;
        mab[make_pair(a[j], b[j])]--;
        j++;
      }
      int len = i - j + 1;
      if (len > ans) {
        ans = len;
        ways = 0;
      }
      if (len == ans) {
        ways++;
      }
    }
    cout << ans << " " << ways << '\n';
  }
  return 0;
}